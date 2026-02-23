@extends('layouts.admin')

@section('admin_content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="margin: 0; color: var(--primary);">Câu hỏi thường gặp (FAQ)</h1>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm câu hỏi</a>
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
                    <th style="width: 30%;">Câu hỏi</th>
                    <th>Câu trả lời</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                    <tr>
                        <td style="font-weight: 600; font-size: 0.95rem;">{{ $faq->question }}</td>
                        <td style="font-size: 0.9rem; color: #555;">{{ $faq->answer }}</td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" style="color: #2196f3;"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
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
