<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $name);
            $validated['image'] = '/uploads/' . $name;
        }

        $validated['features'] = explode("\n", str_replace("\r", "", $request->features_raw));
        $validated['features'] = array_filter(array_map('trim', $validated['features']));

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Thêm dịch vụ thành công.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        unset($validated['image']); // Remove from validated to prevent overwriting with null

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $name);
            $validated['image'] = '/uploads/' . $name;
        }

        $validated['features'] = explode("\n", str_replace("\r", "", $request->features_raw));
        $validated['features'] = array_filter(array_map('trim', $validated['features']));

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Cập nhật dịch vụ thành công.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Xóa dịch vụ thành công.');
    }
}
