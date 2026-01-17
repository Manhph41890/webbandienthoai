    <div class="row">
        <!-- Bảng Top Sản Phẩm Xem Nhiều -->
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-dark">🔥 Top Sản Phẩm "Hot" Nhất (Theo View)</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th class="border-0 px-4">Sản phẩm</th>
                                    <th class="border-0">Chuyên mục</th>
                                    <th class="border-0">Lượt xem</th>
                                    <th class="border-0">Tồn kho</th>
                                    <th class="border-0">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topPhones as $phone)
                                    <tr>
                                        <td class="px-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ Storage::url($phone->main_image) }}" class="rounded mr-2"
                                                    width="40" height="40" style="object-fit: cover;">
                                                <span class="font-weight-bold text-dark">{{ $phone->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $phone->category->name ?? 'N/A' }}</td>
                                        <td>
                                            <div class="badge badge-soft-info">{{ number_format($phone->views_count) }}
                                                views</div>
                                        </td>
                                        <td>{{ $phone->variants_sum_stock ?? 0 }} máy</td>
                                        <td>
                                            @if ($phone->is_active)
                                                <span class="dot bg-success"></span> Đang bán
                                            @else
                                                <span class="dot bg-secondary"></span> Tạm ẩn
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
