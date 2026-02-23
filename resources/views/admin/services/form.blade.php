@extends('layouts.admin')

@section('admin_content')
    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">{{ isset($service) ? 'Chỉnh sửa Dịch vụ' : 'Thêm Dịch vụ mới' }}</h1>
        <a href="{{ route('admin.services.index') }}" style="color: #666; text-decoration: none;"><i class="fas fa-arrow-left"></i> Quay lại danh sách</a>
    </div>

    <div class="card">
        <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($service)) @method('PUT') @endif

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tiêu đề *</label>
                <input type="text" name="title" required value="{{ old('title', $service->title ?? '') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Mô tả *</label>
                <textarea name="description" rows="5" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">{{ old('description', $service->description ?? '') }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Hình ảnh *</label>
                @if(isset($service))
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $service->image }}" style="width: 150px; border-radius: 8px;">
                    </div>
                @endif
                <input type="file" name="image" {{ isset($service) ? '' : 'required' }} style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                <small style="color: #888;">(Chọn file ảnh từ máy tính của bạn)</small>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tính năng (Mỗi dòng 1 tính năng) *</label>
                <textarea name="features_raw" rows="4" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">{{ old('features_raw', isset($service) ? implode("\n", $service->features) : '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($service) ? 'Cập nhật' : 'Lưu lại' }}</button>
        </form>
    </div>
@endsection
