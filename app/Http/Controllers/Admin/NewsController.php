<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $name);
            $validated['image'] = '/uploads/' . $name;
        }

        News::create($validated);
        return redirect()->route('admin.news.index')->with('success', 'Đăng tin tức thành công.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        unset($validated['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $name);
            $validated['image'] = '/uploads/' . $name;
        }

        $news->update($validated);
        return redirect()->route('admin.news.index')->with('success', 'Cập nhật tin tức thành công.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Xóa tin tức thành công.');
    }
}
