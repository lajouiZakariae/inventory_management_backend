<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Roles;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'role_id' => Roles::ADMIN,
            'email' => 'test@example.com',
        ]);

        Role::insert([
            ["name" => "admin"],
            ["name" => "creator"]
        ]);

        Setting::insert([
            [
                'name' => 'theme',
                'value' => 'green',
                'default' => 'green',
                'platform' => 'web_client'
            ],
            [
                'name' => 'theme',
                'value' => 'red',
                'default' => 'green',
                'platform' => 'web_admin'
            ],
            [
                'name' => 'theme',
                'value' => 'blue',
                'default' => 'blue',
                'platform' => 'desktop'
            ],
        ]);

        $this->call([
            // StoreSeeder::class,
            // CategorySeeder::class,
            // PaymentMethodSeeder::class,
            // ProductSeeder::class,
            // HistorySeeder::class,
            // ReviewSeeder::class,
            // MediaSeeder::class,
            // SupplierSeeder::class,
            // PurchaseSeeder::class,
            PurchaseItemSeeder::class,
            // CouponCodeSeeder::class,
            // OrderSeeder::class,
            OrderItemSeeder::class,
        ]);
    }
}
