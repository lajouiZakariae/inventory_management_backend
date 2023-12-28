<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\OrderItemController
 */
final class OrderItemControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $orderItems = OrderItem::factory()->count(3)->create();

        $response = $this->get(route('order-items.index', []));

        $response->assertOk();
        $response->assertJsonStructure(['*' => ['id', 'order_id', 'product_id', 'quantity']]);
    }

    // #[Test]
    // public function store_saves(): void
    // {
    //     $order_id = $this->faker->numberBetween(-10000, 10000);
    //     $product_id = $this->faker->numberBetween(-10000, 10000);
    //     $quantity = $this->faker->numberBetween(-10000, 10000);

    //     $response = $this->post(route('order-items.store'), [
    //         'order_id' => $order_id,
    //         'product_id' => $product_id,
    //         'quantity' => $quantity,
    //     ]);

    //     $orderItems = OrderItem::query()
    //         ->where('order_id', $order_id)
    //         ->where('product_id', $product_id)
    //         ->where('quantity', $quantity)
    //         ->get();
    //     $this->assertCount(1, $orderItems);
    //     $orderItem = $orderItems->first();

    //     $response->assertCreated();
    //     $response->assertJsonStructure([]);
    // }


    // #[Test]
    // public function show_behaves_as_expected(): void
    // {
    //     $orderItem = OrderItem::factory()->create();

    //     $response = $this->get(route('order-items.show', $orderItem));

    //     $response->assertOk();
    //     $response->assertJsonStructure([]);
    // }

    // #[Test]
    // public function update_behaves_as_expected(): void
    // {
    //     $orderItem = OrderItem::factory()->create();
    //     $order_id = $this->faker->numberBetween(-10000, 10000);
    //     $product_id = $this->faker->numberBetween(-10000, 10000);
    //     $quantity = $this->faker->numberBetween(-10000, 10000);

    //     $response = $this->put(route('order-items.update', $orderItem), [
    //         'order_id' => $order_id,
    //         'product_id' => $product_id,
    //         'quantity' => $quantity,
    //     ]);

    //     $orderItem->refresh();

    //     $response->assertOk();
    //     $response->assertJsonStructure([]);

    //     $this->assertEquals($order_id, $orderItem->order_id);
    //     $this->assertEquals($product_id, $orderItem->product_id);
    //     $this->assertEquals($quantity, $orderItem->quantity);
    // }


    // #[Test]
    // public function destroy_deletes_and_responds_with(): void
    // {
    //     $orderItem = OrderItem::factory()->create();

    //     $response = $this->delete(route('order-items.destroy', $orderItem));

    //     $response->assertNoContent();

    //     $this->assertModelMissing($orderItem);
    // }
}
