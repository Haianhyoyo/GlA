@extends('layouts.app')

@section('content')
    <!-- Hero Slider -->
    <section class="hero" id="trang-chu">
        <div class="hero-content">
            <h2>BẠN CẦN CHÚNG TÔI</h2>
            <h1>TƯ VẤN SẢN PHỤ KHOA???</h1>
            <p>Đội ngũ bác sĩ chuyên khoa giàu kinh nghiệm.</p>
            <div class="hotline" style="font-size: 2rem;">24/7: {{ $g_settings['hotline'] ?? '09 7374 8888' }}</div>
        </div>
    </section>

    <!-- Welcome Section -->
    <div id="gioi-thieu" style="text-align: center; padding: 60px 20px;">
        <h2 style="color: var(--primary-blue); text-transform: uppercase;">Chào mừng bạn đến với Phòng khám 8/3</h2>
        <p>Phòng khám là một trong những cơ sở y tế chuyên khoa chuyên nghiệp, uy tín tại miền Bắc.</p>
    </div>

    <!-- Stats/Values -->
    <div style="display: flex; justify-content: center; gap: 40px; margin-bottom: 60px; flex-wrap: wrap;">
        <div style="text-align: center; max-width: 250px;">
            <i class="fas fa-file-signature" style="font-size: 3rem; color: var(--primary-blue);"></i>
            <h3>Chứng chỉ cấp phép</h3>
            <p>Đầy đủ giấy tờ pháp lý từ Bộ Y Tế.</p>
        </div>
        <div style="text-align: center; max-width: 250px;">
            <i class="fas fa-user-md" style="font-size: 3rem; color: var(--primary-blue);"></i>
            <h3>Đội ngũ bác sĩ</h3>
            <p>Chuyên gia đầu ngành trong lĩnh vực sản phụ khoa.</p>
        </div>
        <div style="text-align: center; max-width: 250px;">
            <i class="fas fa-award" style="font-size: 3rem; color: var(--primary-blue);"></i>
            <h3>Bằng khen giải thưởng</h3>
            <p>Được vinh danh qua nhiều năm phục vụ.</p>
        </div>
    </div>

    <!-- Services Section -->
    <section id="dich-vu">
        <h2 class="section-title">Dịch vụ Phòng Khám 8/3</h2>
        <div class="services-grid">
            @foreach($services as $service)
            <div class="service-card">
                <img src="{{ $service->image }}" alt="{{ $service->title }}">
                <div class="service-card-body">
                    <h3 style="color: var(--primary-blue);">{{ $service->title }}</h3>
                    <ul style="list-style: none; padding: 0;">
                        @foreach($service->features as $feature)
                        <li><i class="fas fa-check-circle" style="color: var(--primary-blue); font-size: 0.8rem;"></i> {{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Banner Middle -->
    <div style="background: var(--primary-blue); color: var(--white); padding: 40px 0; text-align: center; margin-top: 60px;">
        <h2>GIẢI ĐOẠN MANG THAI</h2>
        <p>Đồng hành cùng mẹ bầu trong mọi giai đoạn</p>
        <div style="font-weight: bold; font-size: 1.5rem;">Hotline: {{ $g_settings['hotline'] ?? '09 7374 8888' }}</div>
    </div>

    <!-- Testimonials -->
    <section class="testimonials">
        <h2 class="section-title">Ý kiến khách hàng</h2>
        @foreach($testimonials as $t)
        <div class="testimonial-container">
            <p>"{{ $t->content }}"</p>
            <div style="margin-top: 20px;">
                <img src="{{ $t->image }}" style="border-radius: 50%; width: 60px;">
                <h4>{{ $t->author }}</h4>
                <small>{{ $t->info }}</small>
            </div>
        </div>
        @endforeach
    </section>

    <!-- Consultation Form Section -->
    <section id="tu-van" style="background: var(--light-blue); padding: 80px 20px;">
        <div style="max-width: 900px; margin: 0 auto; background: var(--white); padding: 50px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,86,164,0.1);">
            <div style="text-align: center; margin-bottom: 40px;">
                <h2 style="color: var(--primary-blue); text-transform: uppercase; margin-bottom: 10px;">Đăng ký Tư vấn</h2>
                <p style="color: var(--gray-text);">Để lại thông tin, đội ngũ chuyên gia của chúng tôi sẽ liên hệ với bạn trong vòng 15 phút.</p>
            </div>

            @if(session('success'))
                <div style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('consultation.store') }}" method="POST" class="consultation-form">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Họ và tên *</label>
                        <input type="text" name="name" required placeholder="Nhập họ tên của bạn" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Số điện thoại *</label>
                        <input type="text" name="phone" required placeholder="Nhập số điện thoại" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none;">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email (không bắt buộc)</label>
                        <input type="email" name="email" placeholder="Nhập email của bạn" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Dịch vụ quan tâm</label>
                        <select name="service" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none; background: white;">
                            <option value="">-- Chọn dịch vụ --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->title }}">{{ $service->title }}</option>
                            @endforeach
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Lời nhắn / Tình trạng cần tư vấn</label>
                    <textarea name="message" rows="4" placeholder="Nhập nội dung bạn cần chúng tôi tư vấn..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none;"></textarea>
                </div>
                <div style="text-align: center;">
                    <button type="submit" style="background: var(--primary-blue); color: var(--white); border: none; padding: 15px 40px; border-radius: 30px; font-weight: bold; cursor: pointer; transition: all 0.3s; font-size: 1.1rem;">
                        GỬI YÊU CẦU NGAY <i class="fas fa-paper-plane" style="margin-left: 10px;"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- News & FAQ -->
    <div id="tin-tuc" style="max-width: 1200px; margin: 60px auto; display: grid; grid-template-columns: 2fr 1fr; gap: 50px; padding: 0 20px;">
        <section>
            <h3 style="border-bottom: 2px solid var(--primary-blue); padding-bottom: 10px;">Tin tức mới nhất</h3>
            @foreach($news as $n)
            <div style="display: flex; gap: 20px; margin-top: 20px;">
                <img src="{{ $n->image }}" style="width: 150px; height: 100px; object-fit: cover;">
                <div>
                    <h4 style="margin: 0; color: var(--primary-blue);">{{ $n->title }}</h4>
                    <p style="font-size: 0.9rem;">{{ $n->summary }}</p>
                </div>
            </div>
            @endforeach
        </section>
        <section>
            <h3 style="border-bottom: 2px solid var(--primary-blue); padding-bottom: 10px;">Hỏi đáp</h3>
            @foreach($faqs as $f)
            <div style="margin-top: 15px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                <strong style="color: var(--secondary-blue);">Q: {{ $f->question }}</strong>
                <p style="margin: 5px 0 0 0; font-size: 0.9rem;">A: {{ $f->answer }}</p>
            </div>
            @endforeach
        </section>
    </div>
    <!-- Contact Section -->
    <section id="lien-he" style="padding: 80px 20px; background: var(--white);">
        <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start;">
            <div>
                <h2 style="color: var(--primary-blue); text-transform: uppercase; margin-bottom: 30px; position: relative; padding-bottom: 10px;">
                    Liên hệ với chúng tôi
                    <span style="position: absolute; bottom: 0; left: 0; width: 60px; height: 3px; background: var(--primary-blue);"></span>
                </h2>
                <div style="margin-bottom: 25px;">
                    <h3 style="color: var(--secondary-blue); font-size: 1.2rem; margin-bottom: 15px;"><i class="fas fa-map-marker-alt" style="margin-right: 15px; width: 20px; color: var(--primary-blue);"></i> ĐỊA CHỈ</h3>
                    <p style="padding-left: 35px; color: var(--gray-text);">{{ $g_settings['address'] ?? 'Số 32, Tổ 31A Phố Nam Đồng, Phường Kim Liên, Thành Phố Hà Nội' }}</p>
                </div>
                <div style="margin-bottom: 25px;">
                    <h3 style="color: var(--secondary-blue); font-size: 1.2rem; margin-bottom: 15px;"><i class="fas fa-phone-alt" style="margin-right: 15px; width: 20px; color: var(--primary-blue);"></i> HOTLINE</h3>
                    <p style="padding-left: 35px; color: var(--accent-red); font-weight: bold; font-size: 1.2rem;">{{ $g_settings['hotline'] ?? '09 7374 8888' }}</p>
                </div>
                <div style="margin-bottom: 25px;">
                    <h3 style="color: var(--secondary-blue); font-size: 1.2rem; margin-bottom: 15px;"><i class="fas fa-envelope" style="margin-right: 15px; width: 20px; color: var(--primary-blue);"></i> EMAIL</h3>
                    <p style="padding-left: 35px; color: var(--gray-text);">{{ $g_settings['email'] ?? 'lienhe@phongkham83.vn' }}</p>
                </div>
                <div style="margin-bottom: 25px;">
                    <h3 style="color: var(--secondary-blue); font-size: 1.2rem; margin-bottom: 15px;"><i class="fas fa-clock" style="margin-right: 15px; width: 20px; color: var(--primary-blue);"></i> THỜI GIAN LÀM VIỆC</h3>
                    <p style="padding-left: 35px; color: var(--gray-text);">{{ $g_settings['working_hours'] ?? 'Thứ 2 - Chủ Nhật: 08:00 - 20:00 (Kể cả ngày lễ)' }}</p>
                </div>
            </div>
            <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 400px;">
                <!-- Placeholder for Map -->
                <div style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center; flex-direction: column; color: #999;">
                    <i class="fas fa-map-marked-alt" style="font-size: 4rem; margin-bottom: 20px;"></i>
                    <p>BẢN ĐỒ PHÒNG KHÁM</p>
                    <small>(Google Maps Placeholder)</small>
                </div>
            </div>
        </div>
    </section>
@endsection
