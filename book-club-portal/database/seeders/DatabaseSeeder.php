<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ✅ Call the AdminSeeder to insert admin user
        $this->call(AdminSeeder::class);

        // ✅ (Optional) You can also seed dummy users if needed
        // \App\Models\User::factory(3)->create(['role' => 'user']);
    }
}
