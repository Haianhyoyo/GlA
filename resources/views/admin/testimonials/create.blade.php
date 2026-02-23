@extends('layouts.admin')

@section('admin_content')
    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">{{ isset($testimonial) ? 'Chỉnh sửa Phản hồi' : 'Thêm Phản hồi mới' }}</h1>
        <a href="{{ route('admin.testimonials.index') }}" style="color: #666; text-decoration: none;"><i class="fas fa-arrow-left"></i> Quay lại danh sách</a>
    </div>

    <div class="card">
        <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($testimonial)) @method('PUT') @endif

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Họ tên khách hàng *</label>
                <input type="text" name="author" required value="{{ old('author', $testimonial->author ?? '') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Thông tin khách hàng (VD: 25 tuổi, Hà Nội) *</label>
                <input type="text" name="info" required value="{{ old('info', $testimonial->info ?? '') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Ảnh đại diện *</label>
                @if(isset($testimonial))
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $testimonial->image }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                    </div>
                @endif
                <input type="file" name="image" {{ isset($testimonial) ? '' : 'required' }} style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nội dung phản hồi *</label>
                <textarea name="content" rows="4" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">{{ old('content', $testimonial->content ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($testimonial) ? 'Cập nhật' : 'Lưu lại' }}</button>
        </form>
    </div>
@endsection
