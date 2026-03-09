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
            // Handle URL inputs for images (e.g., website_logo_url)
            if (str_ends_with($key, '_url')) {
                $realKey = substr($key, 0, -4);
                $setting = Setting::where('key', $realKey)->first();
                if ($setting && $setting->type === 'image' && !empty($value)) {
                    $setting->update(['value' => $value]);
                }
                continue;
            }

            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                if ($setting->type === 'image' && $request->hasFile($key)) {
                    try {
                        $image = $request->file($key);
                        $name = 'settings_' . $key . '_' . time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads'), $name);
                        $setting->update(['value' => '/uploads/' . $name]);
                    } catch (\Exception $e) {
                        \Log::warning("Failed to upload image $key to public/uploads: " . $e->getMessage());
                        return redirect()->back()->with('error', 'Không thể lưu hình ảnh file. Tuy nhiên các thông tin khác có thể đã được lưu.');
                    }
                } else {
                    $setting->update(['value' => $value]);
                }
            }
        }

        return redirect()->back()->with('success', 'Cập nhật cấu hình thành công.');
    }
}
