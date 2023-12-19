<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\ProductController
 */
final class ProductControllerTest extends TestCase {
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertJsonStructure(['*' => ['id', 'title', 'description', 'cost', 'price', 'stockQuantity', 'published', 'categoryId', 'storeId', 'url']]);
    }

    #[Test]
    public function store_saves(): void {
        $title = $this->faker->sentence(4);
        $cost = $this->faker->randomFloat(max: 25000);
        $price = $this->faker->randomFloat(max: 2500);
        $stock_quantity = $this->faker->numberBetween(-10000, 10000);
        $published = $this->faker->boolean;
        $category_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('products.store'), [
            'title' => $title,
            'cost' => $cost,
            'price' => $price,
            'stock_quantity' => $stock_quantity,
            'published' => $published,
            'category_id' => $category_id,
        ]);

        $products = Product::query()
            ->where('title', $title)
            ->where('cost', $cost)
            ->where('price', $price)
            ->where('stock_quantity', $stock_quantity)
            ->where('published', $published)
            ->where('category_id', $category_id)
            ->get();

        $this->assertCount(1, $products);

        $product = $products->first();

        $response->assertCreated();
    }


    #[Test]
    public function show_behaves_as_expected(): void {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_behaves_as_expected(): void {
        $product = Product::factory()->create();
        $title = $this->faker->sentence(4);
        $cost = $this->faker->randomFloat(
            /** float_attributes **/
        );
        $price = $this->faker->randomFloat(
            /** float_attributes **/
        );
        $stock_quantity = $this->faker->numberBetween(-10000, 10000);
        $published = $this->faker->boolean;
        $category_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('products.update', $product), [
            'title' => $title,
            'cost' => $cost,
            'price' => $price,
            'stock_quantity' => $stock_quantity,
            'published' => $published,
            'category_id' => $category_id,
        ]);

        $product->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $product->title);
        $this->assertEquals($cost, $product->cost);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($stock_quantity, $product->stock_quantity);
        $this->assertEquals($published, $product->published);
        $this->assertEquals($category_id, $product->category_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertNoContent();

        $this->assertModelMissing($product);
    }
}
