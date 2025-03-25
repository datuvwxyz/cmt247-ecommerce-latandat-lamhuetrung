<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kiểm tra nếu chưa có admin trong hệ thống
        if (User::where('email', 'admin@hotmail.com')->doesntExist()) {
            // Tạo tài khoản admin
            User::create([
                'name' => 'Admin',
                'email' => 'admin@hotmail.com',
                'password' => Hash::make('Admin@0801'),  // Mật khẩu đã mã hóa
                'role' => 'admin',  // Cập nhật role là admin
            ]);
        }
    }
}

