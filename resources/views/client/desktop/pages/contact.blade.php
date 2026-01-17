@extends('client.desktop.layouts.app')

@section('content')
    <section class="contact-section">
        <div class="contact-container" style="max-width: 1100px !important">
            <div class="contact-grid">

                <!-- Bên trái: Form liên hệ -->
                <div class="contact-form-side">
                    <h2 class="contact-title">Liên Hệ</h2>
                    <p class="contact-subtitle">Hãy để lại thông tin, chúng tôi sẽ phản hồi bạn trong vòng 24h.</p>

                    <form action="{{ route('contact.store') }}" method="POST" class="main-contact-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ và tên của bạn"
                                required>
                            @error('name')
                                <span class="error-msg" style="color:red; font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                    required>
                                @error('email')
                                    <span class="error-msg" style="color:red; font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                                    placeholder="Số điện thoại" required>
                                @error('phone_number')
                                    <span class="error-msg" style="color:red; font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group">
                            <select name="service" required>
                                <option value="" disabled selected>Vui lòng chọn dịch vụ mà bạn quan tâm *</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->value }}"
                                        {{ old('service') == $service->value ? 'selected' : '' }}>
                                        {{ $service->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service')
                                <span class="error-msg" style="color:red; font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <textarea name="request" rows="4" placeholder="Yêu cầu cụ thể (nếu có)">{{ old('request') }}</textarea>
                            @error('request')
                                <span class="error-msg" style="color:red; font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn-submit">
                                <span>Gửi yêu cầu</span>
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Bên phải: Bản đồ -->
                <div class="contact-map-side">
                    <div class="map-wrapper">
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
                                "mapWidth": "550",
                                "mapHeight": "430"
                            }).render();
                        </script>
                    </div>
                    <div class="contact-container">
                        <!-- Tên cửa hàng từ hình ảnh -->
                        <h2 class="store-name">Điện Thoại Sim thẻ Toàn Hồng Korea</h2>

                        <div class="info-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>부산시 사하구 장림시장4길 19번호 1층<br>
                                19 Jangrimsijang 4-gil, Saha-gu, Busan</span>
                        </div>

                        <div class="info-item">
                            <i class="fa-solid fa-phone"></i>
                            <span>01065652999 - 010 8282 6868</span>
                        </div>

                        <!-- Mục Facebook mới thêm -->
                        <div class="info-item">
                            <i class="fa-brands fa-facebook"></i>
                            <a href="https://www.facebook.com/anhtoan270189/" target="_blank">Toàn Hồng Korea</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@include('pages.contact-lib')
