<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\Role;
use Modules\Auth\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'role_id' => Role::where('name', 'super_admin')->first()->id,
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'phone' => '0900000001',
            'password' => Hash::make('12345678'),
            'is_active' => 'true'
        ]);

        User::create([
            'role_id' => Role::where('name', 'admin')->first()->id,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0900000002',
            'password' => Hash::make('12345678'),
            'is_active' => 'true'
        ]);

        User::create([
            'role_id' => Role::where('name', 'cashier')->first()->id,
            'name' => 'Cashier',
            'email' => 'cashier@gmail.com',
            'phone' => '0900000003',
            'password' => Hash::make('12345678'),
            'is_active' => 'true'
        ]);

        User::create([
            'role_id' => Role::where('name', 'waiter')->first()->id,
            'name' => 'Waiter',
            'email' => 'waiter@gmail.com',
            'phone' => '0900000004',
            'password' => Hash::make('12345678'),
            'is_active' => 'true'
        ]);

        User::create([
            'role_id' => Role::where('name', 'cooker')->first()->id,
            'name' => 'Cooker',
            'email' => 'dith0235@gmail.com',
            'phone' => '0900000005',
            'password' => Hash::make('12345678'),
            'is_active' => 'true'
        ]);
    }
}
