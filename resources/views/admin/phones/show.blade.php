<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ $product->main_image ? Storage::url($product->main_image) : asset('img/no-image.png') }}"
                class="img-fluid rounded" alt="{{ $product->name }}">
            <h5 class="mt-3">Hình ảnh phụ:</h5>
            @if ($product->images->isNotEmpty())
                <div class="row">
                    @foreach ($product->images as $image)
                        <div class="col-4 mb-2">
                            <img src="{{ Storage::url($image->image_path) }}" class="img-fluid rounded border"
                                alt="Product Image">
                        </div>
                    @endforeach
                </div>
            @else
                <p>Không có hình ảnh phụ.</p>
            @endif
        </div>
        <div class="col-md-7">
            <h3>{{ $product->name }}</h3>
            <p class="text-muted"><strong>Danh mục:</strong> {{ $product->category->name ?? 'N/A' }}</p>
            <p><strong>Mô tả ngắn:</strong> {{ $product->short_description ?? 'Không có mô tả ngắn.' }}</p>
            <p><strong>Mô tả chi tiết:</strong></p>
            <div class="border p-3 rounded bg-light" style="max-height: 200px; overflow-y: auto;">
                {!! nl2br(e($product->description)) !!}
            </div>

            <h4 class="mt-4">Biến thể sản phẩm:</h4>
            @if ($product->variants->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Kích thước</th>
                                <th>Màu sắc</th>
                                <th>SKU</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Mặc định</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->id }}</td>
                                    <td>
                                        @if ($variant->image_path)
                                            <img src="{{ Storage::url($variant->image_path) }}" alt="Variant Image"
                                                width="40" class="rounded">
                                        @else
                                            <i class="fas fa-image text-muted"></i>
                                        @endif
                                    </td>
                                    <td>{{ $variant->size->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($variant->color)
                                            <span
                                                style="display: inline-block; width: 20px; height: 20px; background-color: {{ $variant->color->hex_code ?? $variant->color->name }}; border: 1px solid #ccc; vertical-align: middle;"></span>
                                            {{ $variant->color->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $variant->sku ?? 'N/A' }}</td>
                                    <td>{{ number_format($variant->price, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ $variant->stock }}</td>
                                    <td>
                                        @if ($variant->is_default)
                                            <i class="fas fa-check-circle text-success"></i>
                                        @else
                                            <i class="fas fa-times-circle text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Sản phẩm này không có biến thể nào.</p>
            @endif
        </div>
    </div>
</div>
