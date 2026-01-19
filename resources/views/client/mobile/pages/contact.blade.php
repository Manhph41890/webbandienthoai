@extends('layouts.app')

@section('content')
    <section class="contact-mobile-section">
        <div class="mobile-container">
            <!-- Header -->
            <div class="mobile-header">
                <h2 class="mobile-title">Liên Hệ</h2>
                <p class="mobile-subtitle">Chúng tôi sẽ phản hồi bạn trong vòng 24h.</p>
            </div>

            <!-- Form liên hệ -->
            <div class="mobile-card form-card">
                <form action="{{ route('contact.store') }}" method="POST" class="mobile-form">
                    @csrf
                    <div class="m-input-group">
                        <label>Họ và tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên..."
                            required>
                        @error('name')
                            <span class="m-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="m-input-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com"
                            required>
                        @error('email')
                            <span class="m-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="m-input-group">
                        <label>Số điện thoại</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                            placeholder="Số điện thoại của bạn" required>
                        @error('phone_number')
                            <span class="m-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="m-input-group">
                        <label>Dịch vụ quan tâm</label>
                        <select name="service" required>
                            <option value="" disabled selected>Chọn dịch vụ...</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->value }}"
                                    {{ old('service') == $service->value ? 'selected' : '' }}>
                                    {{ $service->value }}
                                </option>
                            @endforeach
                        </select>
                        @error('service')
                            <span class="m-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="m-input-group">
                        <label>Yêu cầu của bạn</label>
                        <textarea name="request" rows="4" placeholder="Viết yêu cầu cụ thể tại đây...">{{ old('request') }}</textarea>
                    </div>

                    <button type="submit" class="m-btn-submit">
                        GỬI YÊU CẦU NGAY
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <!-- Thông tin & Bản đồ -->
            <div class="mobile-card info-card">
                <div class="m-info-list">
                    <div class="m-info-item">
                        <div class="m-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="m-text">
                            <strong>Địa chỉ:</strong>
                            <p>부산시 사하구 장림시장4길 19번호 1층 <br>
                                19 Jangrimsijang 4-gil, Saha-gu, Busan</p>
                        </div>
                    </div>
                    <div class="m-info-item">
                        <div class="m-icon"><i class="fa-solid fa-phone"></i></div>
                        <div class="m-text">
                            <strong>Hotline:</strong>
                            <p>01028288333 - 01082826886</p>
                        </div><br>
                        <div class="info-item">
                            <i class="fa-brands fa-facebook"></i>
                            <a href="https://www.facebook.com/dienthoaituoiduyen/" target="_blank"
                                style="text-decoration: none; color: blacks;">Tươi Duyên Mobile</a>
                        </div>
                    </div>
                </div>

                <div class="m-map-wrapper">
                    <!-- * 카카오맵 - 지도퍼가기 -->
                    <!-- 1. 지도 노드 -->
                    <div id="daumRoughmapContainer1768626191910" class="root_daum_roughmap root_daum_roughmap_landing">
                    </div>

                    <!--
                                                2. 설치 스크립트
                                                * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                                                -->
                    <script charset="UTF-8" class="daum_roughmap_loader_script"
                        src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

                    <!-- 3. 실행 스크립트 -->
                    <script charset="UTF-8">
                        new daum.roughmap.Lander({
                            "timestamp": "1768626191910",
                            "key": "frphd7wf4yk",
                            "mapWidth": "100%",
                            "mapHeight": "250"
                        }).render();
                    </script>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('pages.contact-lib')
