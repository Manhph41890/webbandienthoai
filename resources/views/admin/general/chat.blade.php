<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kiểm tra xem Echo đã sẵn sàng chưa
        if (typeof window.Echo === 'undefined') {
            console.error('Laravel Echo chưa được tải. Hãy kiểm tra npm run dev');
            return;
        }

        let currentReceiverId = null;
        let authId = {{ Auth::id() }};

        // --- HÀM BỔ SUNG: Hiển thị tin nhắn mới lên khung chat ---
        function appendMessage(msg) {
            let side = msg.sender_id == authId ? 'text-right' : 'text-left';
            let color = msg.sender_id == authId ? 'bg-primary text-white' : 'bg-white border';

            let html = `<div class="${side} mb-2">
                            <span class="d-inline-block p-2 rounded ${color}" style="max-width: 85%; word-wrap: break-word;">
                                ${msg.message}
                            </span>
                        </div>`;

            $('#chat-messages').append(html);
            // Cuộn xuống đáy khung chat
            $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        }

        // 1. Click chat từ danh sách nhân viên
        $('.btn-chat').click(function() {
            currentReceiverId = $(this).data('id');
            $('#chat-user-name').text($(this).data('name'));
            $('#chat-box').show();
            $('#chat-messages').html(
                '<div class="text-center small text-muted">Đang tải tin nhắn...</div>');
            loadMessages(currentReceiverId);
        });

        // 2. Load lịch sử tin nhắn
        function loadMessages(userId) {
            window.axios.get(`/chat/messages/${userId}`).then(res => {
                $('#chat-messages').html(''); // Xóa chữ đang tải
                res.data.forEach(msg => {
                    appendMessage(msg);
                });
            });
        }

        // 3. Gửi tin nhắn
        $('#btn-send').click(sendMessage);

        // Cho phép nhấn Enter để gửi
        $('#chat-input').keypress(function(e) {
            if (e.which == 13) sendMessage();
        });

        function sendMessage() {
            let msg = $('#chat-input').val();
            if (!msg || !currentReceiverId) return;

            window.axios.post('/chat/send', {
                receiver_id: currentReceiverId,
                message: msg
            }).then(res => {
                $('#chat-input').val('');
                // Hiện ngay tin nhắn mình vừa gửi lên màn hình
                appendMessage(res.data.message);
            }).catch(err => {
                console.error("Lỗi gửi tin:", err);
            });
        }

        // 4. Lắng nghe Realtime từ người khác gửi tới
        window.Echo.private(`chat.${authId}`)
            .listen('MessageSent', (e) => {
                // Nếu mình đang mở khung chat của đúng người vừa gửi tới
                if (currentReceiverId == e.message.sender_id) {
                    appendMessage(e.message);
                } else {
                    // Nếu đang chat với người khác hoặc chưa mở khung chat thì thông báo
                    alert("Bạn có tin nhắn mới từ " + e.message.sender.name);
                    // Bạn có thể thay alert bằng một tiếng "ting ting" hoặc icon thông báo
                }
            });
    });
</script>
