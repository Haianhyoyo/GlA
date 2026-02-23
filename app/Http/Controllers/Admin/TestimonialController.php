<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'info' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $name);
            $validated['image'] = '/uploads/' . $name;
        }

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Thêm phản hồi thành công.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'info' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        unset($validated['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $name);
            $validated['image'] = '/uploads/' . $name;
        }

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Cập nhật phản hồi thành công.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Xóa phản hồi thành công.');
    }
}
