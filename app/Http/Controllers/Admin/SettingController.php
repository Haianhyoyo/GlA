<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('type');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        
        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                if ($setting->type === 'image' && $request->hasFile($key)) {
                    try {
                        $image = $request->file($key);
                        $name = 'settings_' . $key . '_' . time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads'), $name);
                        $setting->update(['value' => '/uploads/' . $name]);
                    } catch (\Exception $e) {
                        // Fallback: If public/uploads is read-only (like on Vercel), 
                        // we skip the image update but don't crash the whole request.
                        // This allows text settings to still be updated.
                        \Log::warning("Failed to upload image $key to public/uploads: " . $e->getMessage());
                        return redirect()->back()->with('error', 'Không thể lưu hình ảnh do máy chủ ở chế độ chỉ đọc. Tuy nhiên các thông tin khác có thể đã được lưu.');
                    }
                } else if ($setting->type !== 'image') {
                    $setting->update(['value' => $value]);
                }
            }
        }

        return redirect()->back()->with('success', 'Cập nhật cấu hình thành công.');
    }
}
