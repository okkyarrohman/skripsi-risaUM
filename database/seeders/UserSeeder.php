<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $verifiedAt = Carbon::now();

        // Admins
        for ($i = 1; $i <= 2; $i++) {
            $admin = User::create([
                'name' => "Admin $i",
                'email' => "admin$i@example.com",
                'password' => Hash::make('password'),
                'email_verified_at' => $verifiedAt,
            ]);
            $admin->assignRole($adminRole);
        }

        // Users
        for ($i = 1; $i <= 2; $i++) {
            $user = User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'email_verified_at' => $verifiedAt,
            ]);
            $user->assignRole($userRole);
        }
    }
}
