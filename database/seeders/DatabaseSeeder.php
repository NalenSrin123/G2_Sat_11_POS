<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Auth\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(\Modules\Auth\Database\Seeders\AuthDatabaseSeeder::class);

        $roleId = Role::query()->value('id');

        User::factory()->create([
            'role_id' => $roleId,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '0900000099',
            'is_active' => 'true',
        ]);
    }
}
