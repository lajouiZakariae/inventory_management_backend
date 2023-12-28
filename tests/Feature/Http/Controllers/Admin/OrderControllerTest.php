<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\OrderController
 */
final class OrderControllerTest extends TestCase
{
    use  RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('orders.index'));

        $response
            ->assertOk()
            ->assertJsonStructure(['*' => [
                'id',
                'email',
                'status',
                'orderItemsCount',
                'delivery',
                'createdAt',
            ]])
            ->assertJson(function (AssertableJson $json) {
                $json->has(3);
            });
    }

    // #[Test]
    // public function store_saves(): void
    // {
    //     $full_name = $this->faker->word;
    //     $email = $this->faker->safeEmail;
    //     $phone_number = $this->faker->phoneNumber;
    //     $status = $this->faker->randomElement(
    //         /** enum_attributes **/
    //     );
    //     $city = $this->faker->city;
    //     $payment_method_id = $this->faker->numberBetween(-10000, 10000);
    //     $zip_code = $this->faker->word;
    //     $coupon_code_id = $this->faker->numberBetween(-10000, 10000);
    //     $address = $this->faker->word;
    //     $delivery = $this->faker->boolean;

    //     $response = $this->post(route('orders.store'), [
    //         'full_name' => $full_name,
    //         'email' => $email,
    //         'phone_number' => $phone_number,
    //         'status' => $status,
    //         'city' => $city,
    //         'payment_method_id' => $payment_method_id,
    //         'zip_code' => $zip_code,
    //         'coupon_code_id' => $coupon_code_id,
    //         'address' => $address,
    //         'delivery' => $delivery,
    //     ]);

    //     $orders = Order::query()
    //         ->where('full_name', $full_name)
    //         ->where('email', $email)
    //         ->where('phone_number', $phone_number)
    //         ->where('status', $status)
    //         ->where('city', $city)
    //         ->where('payment_method_id', $payment_method_id)
    //         ->where('zip_code', $zip_code)
    //         ->where('coupon_code_id', $coupon_code_id)
    //         ->where('address', $address)
    //         ->where('delivery', $delivery)
    //         ->get();
    //     $this->assertCount(1, $orders);
    //     $order = $orders->first();

    //     $response->assertCreated();
    //     $response->assertJsonStructure([]);
    // }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertJsonStructure([
            "id",
            "email",
            "status",
            "delivery",
            "createdAt",
            "fullName",
            "phoneNumber",
            "city",
            "zipCode",
            "address",
            "paymentMethod" => [
                "id",
                "name",
                "description",
                "url"
            ],
            "orderItemsUrl"
        ]);
    }

    // #[Test]
    // public function update_behaves_as_expected(): void
    // {
    //     $order = Order::factory()->create();
    //     $full_name = $this->faker->word;
    //     $email = $this->faker->safeEmail;
    //     $phone_number = $this->faker->phoneNumber;
    //     $status = $this->faker->randomElement(
    //         /** enum_attributes **/
    //     );
    //     $city = $this->faker->city;
    //     $payment_method_id = $this->faker->numberBetween(-10000, 10000);
    //     $zip_code = $this->faker->word;
    //     $coupon_code_id = $this->faker->numberBetween(-10000, 10000);
    //     $address = $this->faker->word;
    //     $delivery = $this->faker->boolean;

    //     $response = $this->put(route('orders.update', $order), [
    //         'full_name' => $full_name,
    //         'email' => $email,
    //         'phone_number' => $phone_number,
    //         'status' => $status,
    //         'city' => $city,
    //         'payment_method_id' => $payment_method_id,
    //         'zip_code' => $zip_code,
    //         'coupon_code_id' => $coupon_code_id,
    //         'address' => $address,
    //         'delivery' => $delivery,
    //     ]);

    //     $order->refresh();

    //     $response->assertOk();
    //     $response->assertJsonStructure([]);

    //     $this->assertEquals($full_name, $order->full_name);
    //     $this->assertEquals($email, $order->email);
    //     $this->assertEquals($phone_number, $order->phone_number);
    //     $this->assertEquals($status, $order->status);
    //     $this->assertEquals($city, $order->city);
    //     $this->assertEquals($payment_method_id, $order->payment_method_id);
    //     $this->assertEquals($zip_code, $order->zip_code);
    //     $this->assertEquals($coupon_code_id, $order->coupon_code_id);
    //     $this->assertEquals($address, $order->address);
    //     $this->assertEquals($delivery, $order->delivery);
    // }

    // #[Test]
    // public function destroy_deletes_and_responds_with(): void
    // {
    //     $order = Order::factory()->create();

    //     $response = $this->delete(route('orders.destroy', $order));

    //     $response->assertNoContent();

    //     $this->assertModelMissing($order);
    // }
}
