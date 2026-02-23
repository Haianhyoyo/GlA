@extends('layouts.admin')

@section('admin_content')
    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">Chi tiết Yêu cầu Tư vấn</h1>
        <a href="{{ route('admin.consultations.index') }}" style="color: #666; text-decoration: none;"><i class="fas fa-arrow-left"></i> Quay lại danh sách</a>
    </div>

    <div class="card">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <div>
                <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">Thông tin khách hàng</h3>
                <p><strong>Họ tên:</strong> {{ $consultation->name }}</p>
                <p><strong>Số điện thoại:</strong> {{ $consultation->phone }}</p>
                <p><strong>Email:</strong> {{ $consultation->email ?: '(Không có)' }}</p>
                <p><strong>Ngày gửi:</strong> {{ $consultation->created_at->format('H:i d/m/Y') }}</p>
            </div>
            <div>
                <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">Nội dung yêu cầu</h3>
                <p><strong>Dịch vụ quan tâm:</strong> <span style="color: var(--primary); font-weight: bold;">{{ $consultation->service ?: 'Chưa chọn' }}</span></p>
                <p><strong>Lời nhắn:</strong></p>
                <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; font-style: italic;">
                    {{ $consultation->message ?: '(Không có lời nhắn)' }}
                </div>
            </div>
        </div>

        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee;">
            <h3 style="margin-bottom: 20px;">Cập nhật trạng thái</h3>
            <form action="{{ route('admin.consultations.update', $consultation) }}" method="POST" style="display: flex; gap: 15px; align-items: center;">
                @csrf @method('PUT')
                <select name="status" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; width: 250px;">
                    <option value="pending" {{ $consultation->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="contacted" {{ $consultation->status == 'contacted' ? 'selected' : '' }}>Đã liên hệ</option>
                    <option value="completed" {{ $consultation->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                    <option value="cancelled" {{ $consultation->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
                <button type="submit" class="btn btn-primary">Lưu trạng thái</button>
            </form>
        </div>
    </div>
@endsection
