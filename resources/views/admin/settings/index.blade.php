@extends('layouts.admin')

@section('admin_content')
    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">Cấu hình Website</h1>
        <p style="color: #666;">Quản lý các thông tin chung hiển thị trên toàn bộ website.</p>
    </div>

    @if(session('success'))
        <div style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            @foreach($settings as $type => $group)
                <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; color: var(--primary); text-transform: uppercase; font-size: 0.9rem;">
                    {{ $type === 'image' ? 'Hình ảnh & Logo' : 'Thông tin liên hệ' }}
                </h3>
                
                @foreach($group as $setting)
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                            {{ str_replace('_', ' ', strtoupper($setting->key)) }}
                        </label>

                        @if($setting->type === 'image')
                            <div style="margin-bottom: 10px;">
                                @if($setting->value)
                                    @if(Str::startsWith($setting->value, '/uploads'))
                                        <img src="{{ $setting->value }}" style="max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                                    @else
                                        <div style="font-weight: bold; font-size: 1.2rem; display: inline-block; padding: 10px; border: 1px solid #ddd; background: #f9f9f9;">{{ $setting->value }}</div>
                                    @endif
                                @endif
                            </div>
                            <input type="file" name="{{ $setting->key }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                        @elseif($setting->type === 'textarea')
                            <textarea name="{{ $setting->key }}" rows="3" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">{{ $setting->value }}</textarea>
                        @else
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                        @endif
                    </div>
                @endforeach
            @endforeach

            <div style="margin-top: 20px; text-align: right;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">LƯU CẤU HÌNH</button>
            </div>
        </div>
    </form>
@endsection
