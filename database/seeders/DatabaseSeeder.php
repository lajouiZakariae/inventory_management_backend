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

        Setting::factory(3)->create();

        // Setting::insert([
        //     [
        //         "platform" => "desktop",
        //         "settings_value" => json_encode([
        //             "theme" => "red",
        //             "font" => "poppins",
        //             "maintenanceMode" => false
        //         ]),
        //         "settings_default" => json_encode([
        //             "theme" => "blue",
        //             "font" => "consolas",
        //             "maintenanceMode" => true
        //         ]),
        //     ],
        //     [
        //         "platform" => "web_client",
        //         "settings" => json_encode([
        //             "theme" => "green",
        //             "font" => "consolas",
        //             "maintenanceMode" => false
        //         ]),
        //         "settings_default" => json_encode([
        //             "theme" => "red",
        //             "font" => "poppins",
        //             "maintenanceMode" => false
        //         ]),
        //     ],
        // ]);

        $this->call([
            // StoreSeeder::class,
            // CategorySeeder::class,
            // SettingSeeder::class,
            PaymentMethodSeeder::class,
            ProductSeeder::class,
            // HistorySeeder::class,
            // ReviewSeeder::class,
            MediaSeeder::class,
            // SupplierSeeder::class,
            // PurchaseSeeder::class,
            // PurchaseItemSeeder::class,
            // CouponCodeSeeder::class,
            // OrderSeeder::class,
            // OrderItemSeeder::class,
        ]);
    }
}
