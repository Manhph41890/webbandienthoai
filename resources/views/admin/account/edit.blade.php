@extends('admin.layouts')

@section('title', 'Chỉnh sửa tài khoản')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa tài khoản: <span class="text-primary">{{ $account->name }}</span></h1>
        <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại
        </a>
    </div>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật thông tin</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        {{-- Các trường thông tin --}}
                        <div class="form-group">
                            <label for="name">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $account->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email (Không thể thay đổi)</label>
                            <input type="email" class="form-control" id="email" value="{{ $account->email }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone', $account->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bio">Tiểu sử (Bio)</label>
                            <textarea name="bio" id="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio', $account->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <p class="text-muted">Để trống các trường mật khẩu nếu không muốn thay đổi.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Mật khẩu mới</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{-- Các trường tùy chọn --}}
                        <div class="form-group">
                            <label for="role_id">Vai trò (Quyền) <span class="text-danger">*</span></label>
                            <select class="form-control @error('role_id') is-invalid @enderror" id="role_id"
                                name="role_id">
                                <option value="">-- Chọn vai trò --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id', $account->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="is_active">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-control @error('is_active') is-invalid @enderror" id="is_active"
                                name="is_active">
                                <option value="1" {{ old('is_active', $account->is_active) == 1 ? 'selected' : '' }}>
                                    Hoạt động</option>
                                <option value="0" {{ old('is_active', $account->is_active) == 0 ? 'selected' : '' }}>
                                    Khóa</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="avatar">Ảnh đại diện (Avatar)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror"
                                    id="avatar" name="avatar" onchange="previewAvatar(this);">
                                <label class="custom-file-label" for="avatar">Chọn file mới...</label>
                            </div>
                            @error('avatar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <img id="avatar-preview"
                                src="{{ $account->avatar ? asset('storage/' . $account->avatar) : 'https://via.placeholder.com/150' }}"
                                alt="Xem trước avatar" class="img-thumbnail mt-3"
                                style="width: 150px; height: 150px; object-fit: cover;" />
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50"></i> Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Script xem trước ảnh avatar
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatar-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                var fileName = $(input).val().split('\\').pop();
                $(input).next('.custom-file-label').html(fileName);
            }
        }
    </script>
@endpush
