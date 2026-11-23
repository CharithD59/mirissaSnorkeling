<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Creates the default admin accounts. Existing accounts are left untouched,
     * so re-running the seeder never resets a changed password.
     */
    public function run()
    {
        $admins = [
            ['username' => 'admin',  'name' => 'Administrator', 'email' => 'admin@mirissabaybluewhalesnorkelingtour.com'],
            ['username' => 'admin1', 'name' => 'Admin One',     'email' => 'admin1@mirissabaybluewhalesnorkelingtour.com'],
        ];

        foreach ($admins as $admin) {
            if (User::where('username', $admin['username'])->exists()) {
                continue;
            }

            User::create([
                'username'  => $admin['username'],
                'name'      => $admin['name'],
                'email'     => $admin['email'],
                'password'  => Hash::make('123'),
                'role'      => 'admin',
                'is_active' => true,
            ]);
        }
    }
}
