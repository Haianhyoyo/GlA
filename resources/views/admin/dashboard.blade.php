@extends('layouts.admin')

@section('admin_content')
    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">Bảng điều khiển</h1>
        <p style="color: #666;">Tổng quan về hoạt động của website.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 25px; margin-bottom: 40px;">
        <div class="card" style="text-align: center; border-bottom: 4px solid #4caf50;">
            <i class="fas fa-hospital-user" style="font-size: 2rem; color: #4caf50; margin-bottom: 15px;"></i>
            <h2 style="margin: 0;">{{ $stats['services'] }}</h2>
            <p style="color: #888;">Dịch vụ</p>
        </div>
        <div class="card" style="text-align: center; border-bottom: 4px solid #2196f3;">
            <i class="fas fa-newspaper" style="font-size: 2rem; color: #2196f3; margin-bottom: 15px;"></i>
            <h2 style="margin: 0;">{{ $stats['news'] }}</h2>
            <p style="color: #888;">Tin tức</p>
        </div>
        <div class="card" style="text-align: center; border-bottom: 4px solid #ff9800;">
            <i class="fas fa-phone-alt" style="font-size: 2rem; color: #ff9800; margin-bottom: 15px;"></i>
            <h2 style="margin: 0;">{{ $stats['consultations'] }}</h2>
            <p style="color: #888;">Yêu cầu Tư vấn</p>
            @if($stats['pending_consultations'] > 0)
                <div style="background: #ffecb3; color: #ff6f00; font-size: 0.75rem; padding: 2px 8px; border-radius: 10px; display: inline-block; margin-top: 5px;">
                    {{ $stats['pending_consultations'] }} mới
                </div>
            @endif
        </div>
        <div class="card" style="text-align: center; border-bottom: 4px solid #9c27b0;">
            <i class="fas fa-comment-dots" style="font-size: 2rem; color: #9c27b0; margin-bottom: 15px;"></i>
            <h2 style="margin: 0;">{{ $stats['testimonials'] }}</h2>
            <p style="color: #888;">Phản hồi</p>
        </div>
    </div>

    <div class="card">
        <h3>Hành động nhanh</h3>
        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm Dịch vụ</a>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Viết Tin tức</a>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm Câu hỏi</a>
        </div>
    </div>
@endsection
