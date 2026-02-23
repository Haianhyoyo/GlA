@extends('layouts.admin')

@section('admin_content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">Ý kiến khách hàng</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm phản hồi</a>
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
                    <th>Khách hàng</th>
                    <th>Nội dung</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $item)
                    <tr>
                        <td><img src="{{ $item->image }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;"></td>
                        <td>
                            <div style="font-weight: 600;">{{ $item->author }}</div>
                            <div style="font-size: 0.8rem; color: #888;">{{ $item->info }}</div>
                        </td>
                        <td style="font-size: 0.9rem; color: #555;">{{ Str::limit($item->content, 100) }}</td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.testimonials.edit', $item) }}" style="color: #2196f3;"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
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
