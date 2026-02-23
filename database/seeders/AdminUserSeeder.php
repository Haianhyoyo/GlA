<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@phongkham83.vn'],
            [
                'name' => 'Admin System',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
