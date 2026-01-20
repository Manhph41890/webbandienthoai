@guest {{-- Chỉ hiện đoạn này nếu người dùng là khách (chưa login) --}}
    <!-- Thư viện Google -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- Cấu hình Google One Tap -->
    <div id="g_id_onload" data-client_id="479761304566-i84psbv35dri5jrsg7brlp2hnh7mpq49.apps.googleusercontent.com"
        data-login_uri="https://tuoiduyenmobile.com/auth/google/one-tap" data-auto_prompt="true"
        data-use_fedcm_for_prompt="true">
    </div>

    <script>
        window.onload = function() {
            if (typeof google !== 'undefined') {
                google.accounts.id.prompt();
            }
        };
    </script>
@endguest
