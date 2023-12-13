<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\SettingController
 */
final class SettingControllerTest extends TestCase
{
    use  RefreshDatabase, WithFaker;

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $settings = Setting::factory()->create();

        $response = $this->get(route('settings.show',  $settings));

        $response->assertOk();
        $response->assertJsonStructure([
            'platform',
            'settingsValue' => ['theme', 'font', 'maintenanceMode']
        ]);

        $response->assertJson(function (AssertableJson $json) use ($settings) {
            $json
                ->where('platform', $settings->platform)
                ->where('settingsValue.theme', $settings->settings_value->theme)
                ->where('settingsValue.font', $settings->settings_value->font)
                ->where('settingsValue.maintenanceMode', $settings->settings_value->maintenanceMode);
        });
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $setting = Setting::factory()->create();

        $settings_value =  [
            'theme' => fake()->randomElement(['green', 'blue', 'red']),
            'font' => fake()->randomElement(['consolas', 'poppins']),
            'maintenanceMode' => fake()->boolean(1)
        ];

        $response = $this->put(route('settings.update', $setting), $settings_value);

        $setting->refresh();

        $setting->dump();
        $response->assertNoContent();

        $this->assertEquals($settings_value['theme'], $setting->settings_value->theme);
        $this->assertEquals($settings_value['font'], $setting->settings_value->font);
        $this->assertEquals($settings_value['maintenanceMode'], $setting->settings_value->maintenanceMode);
    }
}
