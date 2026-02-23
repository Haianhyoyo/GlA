@extends('layouts.admin')

@section('admin_content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">Quản lý Tin tức</h1>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Đăng tin mới</a>
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
                    <th>Tóm tắt</th>
                    <th>Ngày đăng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                    <tr>
                        <td><img src="{{ $item->image }}" style="width: 80px; border-radius: 4px;"></td>
                        <td style="font-weight: 600;">{{ $item->title }}</td>
                        <td style="font-size: 0.9rem; color: #666;">{{ Str::limit($item->summary, 80) }}</td>
                        <td style="font-size: 0.85rem; color: #888;">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.news.edit', $item) }}" style="color: #2196f3;"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
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
