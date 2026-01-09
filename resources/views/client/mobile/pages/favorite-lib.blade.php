            {{-- PHẦN 2: GÓI CƯỚC DI ĐỘNG --}}
            @if ($packages->isNotEmpty())
                <div class="wishlist-section mt-5">
                    <h4 class="section-title mb-3"><i class="fa-solid fa-sim-card me-2"></i> Gói cước</h4>
                    <div class="row g-3">
                        @foreach ($packages as $item)
                            <div class="col-md-4 product-item">
                                <div
                                    class="card h-100 border-0 shadow-sm bg-light-blue position-relative overflow-hidden">
                                    {{-- Nút xóa nhanh --}}
                                    <button class="btn-favorite btn-remove" data-id="{{ $item->id }}"
                                        data-type="package">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>

                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-shrink-0 bg-white p-2 rounded-3 shadow-sm">
                                            <i class="fa-solid fa-wifi text-primary fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 fw-bold">{{ $item->name }}</h6>
                                            <small class="text-muted">{{ $item->network ?? 'Tất cả nhà mạng' }}</small>
                                            <div class="text-primary fw-bold">{{ number_format($item->price) }}
                                                won/Tháng
                                            </div>
                                        </div>
                                        <a href="https://m.me/100063769254777?text={{ urlencode('Tôi muốn đăng ký gói cước: ' . $item->name) }}"
                                            class="btn btn-primary btn-sm rounded-circle shadow">
                                            <i class="fab fa-facebook-messenger"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
