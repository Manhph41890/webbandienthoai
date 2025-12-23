@php
    // Đảm bảo $phone được truyền vào từ controller
    // $phone->load('category', 'variants.size', 'variants.color', 'images');
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 text-center">
            @if ($phone->main_image)
                <img src="{{ Storage::url($phone->main_image) }}" class="img-fluid rounded mb-3"
                    alt="{{ $phone->name }}">
            @else
                <img src="https://via.placeholder.com/200?text=No+Image" class="img-fluid rounded mb-3" alt="No Image">
            @endif
            <h5>{{ $phone->name }}</h5>
            <p class="text-muted">{{ $phone->category->name ?? 'Không có danh mục' }}</p>
        </div>
        <div class="col-md-8">
            <p><strong>Mô tả ngắn:</strong> {{ $phone->short_description ?? 'N/A' }}</p>
            <h6>Mô tả chi tiết:</h6>
            <p>{{ $phone->description ?? 'N/A' }}</p>

            <hr>
            <h6>Biến thể sản phẩm:</h6>
            @if ($phone->variants->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SKU</th>
                                <th>Kích thước</th>
                                <th>Màu sắc</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Mặc định</th>
                                <th>Ảnh biến thể</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phone->variants as $variant)
                                <tr>
                                    <td>{{ $variant->id }}</td>
                                    <td>{{ $variant->sku ?? 'N/A' }}</td>
                                    <td>{{ $variant->size->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($variant->color)
                                            <span
                                                style="display:inline-block; width:20px; height:20px; background-color:{{ $variant->color->hex_code ?? $variant->color->name }}; border:1px solid #ccc; vertical-align:middle;"></span>
                                            {{ $variant->color->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ number_format($variant->price, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ $variant->stock }}</td>
                                    <td>
                                        @if ($variant->is_default)
                                            <span class="badge bg-success text-white">Có</span>
                                        @else
                                            <span class="badge bg-secondary text-white">Không</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($variant->image_path)
                                            <img src="{{ Storage::url($variant->image_path) }}" alt="Variant Image"
                                                width="40" class="img-thumbnail">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Không có biến thể nào cho sản phẩm này.</p>
            @endif

            <hr>
            <h6>Thư viện hình ảnh:</h6>
            @if ($phone->images->isNotEmpty())
                <div class="row">
                    @foreach ($phone->images as $image)
                        <div class="col-md-3 mb-2">
                            <img src="{{ Storage::url($image->image_path) }}" class="img-fluid rounded"
                                alt="phone Gallery Image">
                        </div>
                    @endforeach
                </div>
            @else
                <p>Không có hình ảnh phụ nào.</p>
            @endif
        </div>
    </div>
</div>
