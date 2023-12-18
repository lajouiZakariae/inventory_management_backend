<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\MediaController
 */
final class MediaControllerTest extends TestCase {
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void {
        $media = Media::factory()->count(3)->create();

        $response = $this->get(route('media.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    // #[Test]
    // public function store_saves(): void
    // {
    //     $alt_text = $this->faker->word;
    //     $path = $this->faker->word;
    //     $type = $this->faker->randomElement(["video", "image"]);
    //     $product_id = $this->faker->numberBetween(-10000, 10000);

    //     $response = $this->post(route('media.store'), [
    //         'alt_text' => $alt_text,
    //         'path' => $path,
    //         'type' => $type,
    //         'product_id' => $product_id,
    //     ]);

    //     $media = Media::query()
    //         ->where('alt_text', $alt_text)
    //         ->where('path', $path)
    //         ->where('type', $type)
    //         ->where('product_id', $product_id)
    //         ->get();
    //     $this->assertCount(1, $media);
    //     $media = $media->first();

    //     $response->assertCreated();
    //     $response->assertJsonStructure([]);
    // }


    #[Test]
    public function show_behaves_as_expected(): void {
        $media = Media::factory()->create();

        $response = $this->get(route('media.show', $media));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void {
        $media = Media::factory()->create();

        $response = $this->delete(route('media.destroy', $media));

        $response->assertNoContent();

        $this->assertModelMissing($media);
    }
}
