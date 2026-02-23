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
                    $image = $request->file($key);
                    $name = 'settings_' . $key . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads'), $name);
                    $setting->update(['value' => '/uploads/' . $name]);
                } else if ($setting->type !== 'image') {
                    $setting->update(['value' => $value]);
                }
            }
        }

        return redirect()->back()->with('success', 'Cập nhật cấu hình thành công.');
    }
}
