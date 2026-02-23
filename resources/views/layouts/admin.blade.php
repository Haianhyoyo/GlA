<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Phòng Khám 8/3</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0056A4;
            --secondary: #004482;
            --bg: #f4f7fa;
            --text: #333;
            --sidebar-w: 260px;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); margin: 0; display: flex; }
        .sidebar { width: var(--sidebar-w); background: var(--primary); color: white; height: 100vh; position: fixed; }
        .sidebar-header { padding: 30px 20px; font-size: 1.2rem; font-weight: bold; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-menu { padding: 20px 0; }
        .sidebar-menu a { display: block; padding: 12px 30px; color: rgba(255,255,255,0.8); text-decoration: none; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.1); color: white; border-left: 4px solid white; }
        .sidebar-menu a i { margin-right: 15px; width: 20px; text-align: center; }
        
        .main-content { margin-left: var(--sidebar-w); flex: 1; min-height: 100vh; display: flex; flex-direction: column; }
        header { background: white; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .container { padding: 40px; }
        
        .card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .btn { padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; transition: 0.3s; text-decoration: none; display: inline-block; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--secondary); }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #fafafa; font-weight: 600; color: #666; }
        
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }
        .badge-pending { background: #fff3e0; color: #e65100; }
        .badge-completed { background: #e8f5e9; color: #2e7d32; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">PHÒNG KHÁM 8/3 ADMIN</div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->is('admin/services*') ? 'active' : '' }}"><i class="fas fa-hospital-user"></i> Dịch vụ</a>
            <a href="{{ route('admin.news.index') }}" class="{{ request()->is('admin/news*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Tin tức</a>
            <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->is('admin/testimonials*') ? 'active' : '' }}"><i class="fas fa-comment-dots"></i> Ý kiến khách hàng</a>
            <a href="{{ route('admin.faqs.index') }}" class="{{ request()->is('admin/faqs*') ? 'active' : '' }}"><i class="fas fa-question-circle"></i> Hỏi đáp (FAQ)</a>
            <a href="{{ route('admin.consultations.index') }}" class="{{ request()->is('admin/consultations*') ? 'active' : '' }}"><i class="fas fa-phone-alt"></i> Yêu cầu Tư vấn</a>
            <a href="{{ route('admin.settings.index') }}" class="{{ request()->is('admin/settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i> Cấu hình website</a>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div style="color: #666;">Xin chào, <strong>{{ Auth::user()->name }}</strong></div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn" style="background: none; color: #d32f2f;"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
            </form>
        </header>

        <div class="container">
            @yield('admin_content')
        </div>
    </div>
</body>
</html>
