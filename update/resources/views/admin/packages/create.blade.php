@extends('admin.layouts')

@section('title', 'Thêm mới Gói Cước')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Thêm mới Gói Cước</h1>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary btn-sm shadow-sm border-0"
            style="border-radius: 8px;">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại
        </a>
    </div>

    {{-- @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm">
            <h6 class="font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Có lỗi xảy ra!</h6>
            <ul class="mb-0 mt-2 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="card shadow border-0 mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin chi tiết gói cước</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.packages.store') }}" method="POST">
                @csrf
                <div class="row">
                    {{-- Cột trái: Thông tin chính --}}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="font-weight-bold">Tên Gói Cước <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Ví dụ: VD90, 6M_BIG70...">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Slug (URL)</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug') }}" placeholder="tu-dong-tao-neu-de-trong">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Giá cước (VND) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ old('price') }}" placeholder="90000">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Thời hạn (Ngày) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('duration_days') is-invalid @enderror"
                                        name="duration_days" value="{{ old('duration_days', 30) }}">
                                </div>
                            </div>
                        </div>

                        {{-- Phần Specifications (Lưu vào JSON) --}}
                        <div class="card bg-light border-0 mb-3">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">Thông số kỹ thuật (Hiển thị)
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group small">
                                            <label>Data mỗi tháng</label>
                                            <input type="text" name="specifications[data_thang]"
                                                class="form-control form-control-sm" placeholder="Ví dụ: 30GB"
                                                value="{{ old('specifications.data_thang') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group small">
                                            <label>Data mỗi ngày</label>
                                            <input type="text" name="specifications[data_ngay]"
                                                class="form-control form-control-sm" placeholder="Ví dụ: 1GB/ngày"
                                                value="{{ old('specifications.data_ngay') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group small mb-0">
                                            <label>Ưu đãi gọi thoại</label>
                                            <textarea name="specifications[uu_dai_thoai]" class="form-control form-control-sm" rows="2"
                                                placeholder="Miễn phí nội mạng < 10p...">{{ old('specifications.uu_dai_thoai') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Mô tả chi tiết</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    {{-- Cột phải: Các thuộc tính lựa chọn --}}
                    <div class="col-md-4">
                        <div class="card border-0 bg-light shadow-sm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nhà mạng</label>
                                    <select class="form-control" name="carrier">
                                        <option value="sk" {{ old('carrier') == 'sk' ? 'selected' : '' }}>SK (Hàn Quốc)
                                        </option>
                                        <option value="kt" {{ old('carrier') == 'kt' ? 'selected' : '' }}>KT (Hàn Quốc)
                                        </option>
                                        <option value="lgu" {{ old('carrier') == 'lgu' ? 'selected' : '' }}>LGU+ (Hàn
                                            Quốc)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Loại hình thanh toán</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tra_truoc" name="payment_type" value="tra_truoc"
                                            class="custom-control-input"
                                            {{ old('payment_type', 'tra_truoc') == 'tra_truoc' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="tra_truoc">Trả trước</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tra_sau" name="payment_type" value="tra_sau"
                                            class="custom-control-input"
                                            {{ old('payment_type') == 'tra_sau' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="tra_sau">Trả sau</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Loại SIM</label>
                                    <select class="form-control font-weight-bold text-primary" name="sim_type">
                                        <option value="hop_phap" {{ old('sim_type') == 'hop_phap' ? 'selected' : '' }}>SIM
                                            Hợp pháp</option>
                                        <option value="bat_hop_phap"
                                            {{ old('sim_type') == 'bat_hop_phap' ? 'selected' : '' }}>SIM Bất hợp pháp
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Tình trạng hàng</label>
                                    <select class="form-control" name="status">
                                        <option value="con_hang" {{ old('status') == 'con_hang' ? 'selected' : '' }}>Còn
                                            hàng</option>
                                        <option value="het_hang" {{ old('status') == 'het_hang' ? 'selected' : '' }}>Hết
                                            hàng</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold" for="category_id">Danh mục</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (isset($package) && $package->category_id == $category->id) || old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active"
                                            name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold" for="is_active">Cho phép hoạt
                                            động</label>
                                    </div>
                                    <small class="text-muted">Nếu tắt, gói cước sẽ không hiển thị trên website.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-4">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary px-5 shadow-sm" style="border-radius: 8px;">
                        <i class="fas fa-save mr-2"></i> Lưu gói cước
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-light px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Tự động tạo Slug khi nhập tên
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var name = $(this).val();
                var slug = name.toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
                $('#slug').val(slug);
            });
        });
    </script>
@endpush
