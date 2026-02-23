@extends('layouts.admin')

@section('admin_content')
    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">{{ isset($news) ? 'Chỉnh sửa Tin tức' : 'Đăng Tin tức mới' }}</h1>
        <a href="{{ route('admin.news.index') }}" style="color: #666; text-decoration: none;"><i class="fas fa-arrow-left"></i> Quay lại danh sách</a>
    </div>

    <div class="card">
        <form action="{{ isset($news) ? route('admin.news.update', $news) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($news)) @method('PUT') @endif

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tiêu đề *</label>
                <input type="text" name="title" required value="{{ old('title', $news->title ?? '') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tóm tắt nội dung *</label>
                <textarea name="summary" rows="5" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">{{ old('summary', $news->summary ?? '') }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Hình ảnh minh họa *</label>
                @if(isset($news))
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $news->image }}" style="width: 150px; border-radius: 8px;">
                    </div>
                @endif
                <input type="file" name="image" {{ isset($news) ? '' : 'required' }} style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($news) ? 'Cập nhật' : 'Đăng bài' }}</button>
        </form>
    </div>
@endsection
