@extends('layouts.admin')

@section('admin_content')
    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">{{ isset($faq) ? 'Chỉnh sửa Câu hỏi' : 'Thêm Câu hỏi mới' }}</h1>
        <a href="{{ route('admin.faqs.index') }}" style="color: #666; text-decoration: none;"><i class="fas fa-arrow-left"></i> Quay lại danh sách</a>
    </div>

    <div class="card">
        <form action="{{ isset($faq) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" method="POST">
            @csrf
            @if(isset($faq)) @method('PUT') @endif

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Câu hỏi *</label>
                <textarea name="question" rows="3" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">{{ old('question', $faq->question ?? '') }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Câu trả lời *</label>
                <textarea name="answer" rows="5" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">{{ old('answer', $faq->answer ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($faq) ? 'Cập nhật' : 'Lưu lại' }}</button>
        </form>
    </div>
@endsection
