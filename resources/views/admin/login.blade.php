<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Phòng Khám 8/3</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f4f7fa; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #0056A4; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; outline: none; transition: 0.3s; }
        input:focus { border-color: #0056A4; box-shadow: 0 0 0 3px rgba(0,86,164,0.1); }
        button { width: 100%; padding: 14px; background: #0056A4; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button:hover { background: #004482; }
        .error { color: #d32f2f; font-size: 0.85rem; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>ĐĂNG NHẬP ADMIN</h2>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="admin@example.com" value="{{ old('email') }}">
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" required placeholder="********">
            </div>
            <button type="submit">ĐĂNG NHẬP</button>
        </form>
    </div>
</body>
</html>
