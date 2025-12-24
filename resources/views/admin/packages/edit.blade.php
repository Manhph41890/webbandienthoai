@extends('admin.layouts')

@section('title', 'Chỉnh sửa Gói Cước')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
            Chỉnh sửa Gói Cước: <span class="text-primary">{{ $package->name }}</span>
        </h1>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary btn-sm shadow-sm border-0">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại danh sách
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm">
            <h6 class="font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Có lỗi xảy ra!</h6>
            <ul class="mb-0 mt-2 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 bg-white border-bottom">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật thông tin chi tiết</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Cột trái: Thông tin chính --}}
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tên Gói Cước <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $package->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Phí gói (VND) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ old('price', $package->price) }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Thời hạn (Ngày) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('duration_days') is-invalid @enderror"
                                        name="duration_days" value="{{ old('duration_days', $package->duration_days) }}">
                                    @error('duration_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-primary mt-2"><i class="fas fa-microchip mr-1"></i> Thông số
                                kỹ thuật (JSON)</label>
                            <div class="p-3 border rounded bg-light">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small font-weight-bold">Data mỗi tháng</label>
                                            <input type="text" name="specifications[data_thang]"
                                                class="form-control form-control-sm"
                                                value="{{ old('specifications.data_thang', $package->specifications['data_thang'] ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small font-weight-bold">Data mỗi ngày</label>
                                            <input type="text" name="specifications[data_ngay]"
                                                class="form-control form-control-sm"
                                                value="{{ old('specifications.data_ngay', $package->specifications['data_ngay'] ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="small font-weight-bold">Thông tin gọi thoại</label>
                                            <input type="text" name="specifications[uu_dai_thoai]"
                                                class="form-control form-control-sm"
                                                value="{{ old('specifications.uu_dai_thoai', $package->specifications['uu_dai_thoai'] ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Mô tả chi tiết</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description', $package->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Cột phải: Phân loại & Cấu hình --}}
                    <div class="col-md-4">
                        <div class="card bg-light border-0 shadow-sm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nhà mạng <span class="text-danger">*</span></label>
                                    <select class="form-control" name="carrier">
                                        <option value="sk"
                                            {{ old('carrier', $package->carrier) == 'sk' ? 'selected' : '' }}>SK (Hàn Quốc)
                                        </option>
                                        <option value="kt"
                                            {{ old('carrier', $package->carrier) == 'kt' ? 'selected' : '' }}>KT (Hàn Quốc)
                                        </option>
                                        <option value="lgu"
                                            {{ old('carrier', $package->carrier) == 'lgu' ? 'selected' : '' }}>LG U+ (Hàn
                                            Quốc)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Loại thanh toán</label>
                                    <select class="form-control" name="payment_type">
                                        <option value="tra_truoc"
                                            {{ old('payment_type', $package->payment_type) == 'tra_truoc' ? 'selected' : '' }}>
                                            Trả trước</option>
                                        <option value="tra_sau"
                                            {{ old('payment_type', $package->payment_type) == 'tra_sau' ? 'selected' : '' }}>
                                            Trả sau</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Loại SIM</label>
                                    <select class="form-control" name="sim_type">
                                        <option value="hop_phap"
                                            {{ old('sim_type', $package->sim_type) == 'hop_phap' ? 'selected' : '' }}>Hợp
                                            pháp (Chính chủ)</option>
                                        <option value="bat_hop_phap"
                                            {{ old('sim_type', $package->sim_type) == 'bat_hop_phap' ? 'selected' : '' }}>
                                            Bất hợp pháp</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Tình trạng kho</label>
                                    <select class="form-control" name="status">
                                        <option value="con_hang"
                                            {{ old('status', $package->status) == 'con_hang' ? 'selected' : '' }}>Còn hàng
                                        </option>
                                        <option value="het_hang"
                                            {{ old('status', $package->status) == 'het_hang' ? 'selected' : '' }}>Hết hàng
                                        </option>
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="font-weight-bold">Đường dẫn (Slug)</label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('slug') is-invalid @enderror"
                                        name="slug" value="{{ old('slug', $package->slug) }}">
                                    <small class="form-text text-muted italic">Bỏ trống sẽ tự tạo từ tên.</small>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active"
                                            name="is_active" value="1"
                                            {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold" for="is_active">Cho phép hoạt
                                            động</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 small text-muted">
                            <p class="mb-1"><i class="fas fa-calendar-plus mr-1"></i> Ngày tạo:
                                {{ $package->created_at->format('d/m/Y H:i') }}</p>
                            <p><i class="fas fa-edit mr-1"></i> Cập nhật mới nhất:
                                {{ $package->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="text-right">
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary px-4 shadow-sm">Hủy bỏ</a>
                    <button type="submit" class="btn btn-warning px-4 shadow-sm font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Cập nhật Gói cước
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
