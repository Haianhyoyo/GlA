@extends('layouts.admin')

@section('admin_content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">Quản lý Dịch vụ</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
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
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Tính năng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td><img src="{{ $service->image }}" style="width: 80px; border-radius: 4px;"></td>
                        <td style="font-weight: 600;">{{ $service->title }}</td>
                        <td style="font-size: 0.9rem; color: #666;">{{ Str::limit($service->description, 50) }}</td>
                        <td>
                            @foreach($service->features ?? [] as $feature)
                                <span style="display: inline-block; background: #f0f0f0; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; margin: 2px;">{{ $feature }}</span>
                            @endforeach
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.services.edit', $service) }}" style="color: #2196f3;"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
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
