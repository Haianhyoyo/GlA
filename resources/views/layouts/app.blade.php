<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phòng Khám 8/3 - Chăm sóc sức khỏe phụ nữ</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="top-bar">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between;">
            <span><i class="fas fa-map-marker-alt"></i> {{ $g_settings['address'] ?? 'Số 32, Tổ 31A Phố Nam Đồng, Phường Kim Liên, Thành Phố Hà Nội' }}</span>
            <span><i class="fas fa-phone"></i> Hotline: {{ $g_settings['hotline'] ?? '09 7374 8888' }}</span>
        </div>
    </div>

    <header>
        <nav class="navbar">
            <div class="logo">
                @if(isset($g_settings['website_logo']))
                    @if(Str::startsWith($g_settings['website_logo'], ['/uploads', 'http', 'https']) 
                        || Str::endsWith(strtolower($g_settings['website_logo']), ['.png', '.jpg', '.jpeg', '.svg', '.webp']))
                        <img src="{{ $g_settings['website_logo'] }}" alt="Logo" style="height: 50px;">
                    @else
                        <h2 style="margin: 0; color: var(--primary-blue);">{{ $g_settings['website_logo'] }}</h2>
                    @endif
                @else
                    <img src="https://via.placeholder.com/150x50?text=PHONG+KHAM+8/3" alt="Logo">
                @endif
            </div>
            <div class="nav-links">
                <a href="#trang-chu">Trang chủ</a>
                <a href="#gioi-thieu">Giới thiệu</a>
                <a href="#dich-vu">Dịch vụ</a>
                <a href="#tu-van">Tư vấn</a>
                <a href="#lien-he">Liên hệ</a>
            </div>
            <div class="hotline">
                Gọi ngay: {{ $g_settings['hotline'] ?? '09 7374 8888' }}
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer id="footer">
        <div class="footer-content">
            <div>
                <h3>{{ $g_settings['website_name'] ?? 'PHÒNG KHÁM 8/3' }}</h3>
                <p>Tận tâm - Nhiệt tình - Chu đáo</p>
                <p>Địa chỉ: {{ $g_settings['address'] ?? 'Số 32, Tổ 31A Phố Nam Đồng, Phường Kim Liên, Thành Phố Hà Nội' }}</p>
            </div>
            <div>
                <h3>DỊCH VỤ</h3>
                <ul>
                    <li>Siêu âm</li>
                    <li>Khám thai</li>
                    <li>Sản phụ khoa</li>
                </ul>
            </div>
            <div>
                <h3>KẾT NỐI VỚI CHÚNG TÔI</h3>
                <div class="social-links">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 30px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
            &copy; 2024 Phong Kham 8/3. All rights reserved.
        </div>
    </footer>
</body>
</html>
