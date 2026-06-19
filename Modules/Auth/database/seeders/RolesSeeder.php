<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('roles')->insertOrIgnore([
            [
                'name'        => 'super_admin',
                'description' => 'Super Admin',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'admin',
                'description' => 'Admin',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'cashier',
                'description' => 'Cashier',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'waiter',
                'description' => 'Waiter',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'cooker',
                'description' => 'Cooker',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
