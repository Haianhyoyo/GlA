<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'website_logo',
                'value' => 'Logo', // Placeholder text logo
                'type' => 'image',
            ],
            [
                'key' => 'website_name',
                'value' => 'Phòng Khám 8/3',
                'type' => 'text',
            ],
            [
                'key' => 'hotline',
                'value' => '09 7374 8888',
                'type' => 'text',
            ],
            [
                'key' => 'address',
                'value' => 'Số 10, ngõ 183, Đặng Tiến Đông, Đống Đa, Hà Nội',
                'type' => 'text',
            ],
            [
                'key' => 'working_hours',
                'value' => 'Thứ 2 - Chủ Nhật: 08:00 - 20:00',
                'type' => 'text',
            ],
            [
                'key' => 'email',
                'value' => 'contact@phongkham83.vn',
                'type' => 'text',
            ],
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/phongkham83',
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
