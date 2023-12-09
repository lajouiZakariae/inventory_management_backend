<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\SettingController
 */
final class SettingControllerTest extends TestCase
{
    use  RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $settings = Setting::factory()->count(3)->create();

        $response = $this->get(route('settings.index'));

        $response->assertOk();
        $response->assertJsonStructure(['*' => ['id', 'name', 'value']]);
    }

    // #[Test]
    // public function update_behaves_as_expected(): void
    // {
    //     $setting = Setting::factory()->create();
    //     $name = $this->faker->name;
    //     $value = $this->faker->word;
    //     $default = $this->faker->word;
    //     $platform = $this->faker->randomElement(
    //         /** enum_attributes **/
    //     );

    //     $response = $this->put(route('setting.update', $setting), [
    //         'name' => $name,
    //         'value' => $value,
    //         'default' => $default,
    //         'platform' => $platform,
    //     ]);

    //     $setting->refresh();

    //     $response->assertOk();
    //     $response->assertJsonStructure([]);

    //     $this->assertEquals($name, $setting->name);
    //     $this->assertEquals($value, $setting->value);
    //     $this->assertEquals($default, $setting->default);
    //     $this->assertEquals($platform, $setting->platform);
    // }
}
