<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Media;
use App\Models\Medium;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\MediaController
 */
final class MediaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $media = Media::factory()->count(3)->create();

        $response = $this->get(route('medium.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\MediaController::class,
            'store',
            \App\Http\Requests\Admin\MediaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $alt_text = $this->faker->word;
        $path = $this->faker->word;
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $product_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('medium.store'), [
            'alt_text' => $alt_text,
            'path' => $path,
            'type' => $type,
            'product_id' => $product_id,
        ]);

        $media = Medium::query()
            ->where('alt_text', $alt_text)
            ->where('path', $path)
            ->where('type', $type)
            ->where('product_id', $product_id)
            ->get();
        $this->assertCount(1, $media);
        $medium = $media->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $medium = Media::factory()->create();

        $response = $this->get(route('medium.show', $medium));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\MediaController::class,
            'update',
            \App\Http\Requests\Admin\MediaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $medium = Media::factory()->create();
        $alt_text = $this->faker->word;
        $path = $this->faker->word;
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $product_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('medium.update', $medium), [
            'alt_text' => $alt_text,
            'path' => $path,
            'type' => $type,
            'product_id' => $product_id,
        ]);

        $medium->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($alt_text, $medium->alt_text);
        $this->assertEquals($path, $medium->path);
        $this->assertEquals($type, $medium->type);
        $this->assertEquals($product_id, $medium->product_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $medium = Media::factory()->create();
        $medium = Medium::factory()->create();

        $response = $this->delete(route('medium.destroy', $medium));

        $response->assertNoContent();

        $this->assertModelMissing($medium);
    }
}
