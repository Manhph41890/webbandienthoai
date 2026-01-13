<div class="col-lg-4">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-dark">Nhân Viên Trực Tuyến</h6>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @forelse ($employees as $emp)
                    <div class="list-group-item border-0 d-flex align-items-center py-3">
                        <div class="position-relative mr-3">
                            <img src="{{ Storage::url($emp->avatar) }}" class="rounded-circle" width="40"
                                height="40">
                            <!-- Chấm xanh Online -->
                            <span class="position-absolute border border-white rounded-circle bg-success"
                                style="bottom: 0; right: 0; width: 12px; height: 12px;" title="Online"></span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 text-sm font-weight-bold">{{ $emp->name }}</h6>
                            <!-- Hiển thị tên Role từ DB (Quản trị viên/Nhân viên) -->
                            <p class="mb-0 text-xs text-muted">{{ $emp->role->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-light-primary rounded-circle btn-chat"
                                data-id="{{ $emp->id }}" data-name="{{ $emp->name }}">
                                <i class="far fa-comment-dots"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="p-3 text-center text-muted">Không có nhân viên nào trực tuyến</div>
                @endforelse
            </div>
        </div>
        <div class="card-footer bg-white text-center border-0">
            <a href="{{ route('admin.accounts.index') }}" class="text-primary small font-weight-bold">Quản lý nhân sự <i
                    class="fas fa-chevron-right ml-1"></i></a>
        </div>
    </div>
</div>


<!-- Thêm Khung Chat ẩn ở cuối trang -->
<div id="chat-box" class="card shadow position-fixed"
    style="bottom: 20px; right: 20px; width: 300px; display: none; z-index: 9999;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span id="chat-user-name">Tên nhân viên</span>
        <button type="button" class="close text-white" onclick="$('#chat-box').hide()">&times;</button>
    </div>
    <div class="card-body" id="chat-messages" style="height: 300px; overflow-y: auto; background: #f8f9fa;">
        <!-- Tin nhắn sẽ load ở đây -->
    </div>
    <div class="card-footer p-2">
        <div class="input-group">
            <input type="text" id="chat-input" class="form-control form-control-sm" placeholder="Nhập tin nhắn...">
            <div class="input-group-append">
                <button class="btn btn-primary btn-sm" id="btn-send"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
@include('admin.general.chat')