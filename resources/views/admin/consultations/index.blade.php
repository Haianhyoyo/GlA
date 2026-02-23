@extends('layouts.admin')

@section('admin_content')
    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">Yêu cầu Tư vấn</h1>
        <p style="color: #666;">Danh sách khách hàng đăng ký tư vấn từ trang chủ.</p>
    </div>

    @if(session('success'))
        <div style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Khách hàng</th>
                    <th>Liên hệ</th>
                    <th>Dịch vụ</th>
                    <th>Ngày gửi</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $con)
                    <tr>
                        <td style="font-weight: 600;">{{ $con->name }}</td>
                        <td style="font-size: 0.9rem;">
                            <div><i class="fas fa-phone"></i> {{ $con->phone }}</div>
                            <div style="color: #888;">{{ $con->email }}</div>
                        </td>
                        <td style="font-size: 0.9rem;">{{ $con->service ?: 'Chưa chọn' }}</td>
                        <td style="font-size: 0.85rem; color: #888;">{{ $con->created_at->format('H:i d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('admin.consultations.update', $con) }}" method="POST">
                                @csrf @method('PUT')
                                <select name="status" onchange="this.form.submit()" 
                                    style="padding: 5px; border: 1px solid #ddd; border-radius: 4px; font-size: 0.85rem; 
                                    background: {{ $con->status == 'pending' ? '#fff3e0' : ($con->status == 'completed' ? '#e8f5e9' : '#fff') }}">
                                    <option value="pending" {{ $con->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="contacted" {{ $con->status == 'contacted' ? 'selected' : '' }}>Đã liên hệ</option>
                                    <option value="completed" {{ $con->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="cancelled" {{ $con->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.consultations.show', $con) }}" style="color: #2196f3;"><i class="fas fa-eye"></i></a>
                                <form action="{{ route('admin.consultations.destroy', $con) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #f44336; cursor: pointer;"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
