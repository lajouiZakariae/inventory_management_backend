<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\CouponCode;
use App\Models\Purchase;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\PurchaseController
 */
final class PurchaseControllerTest extends TestCase
{
    use  RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $purchases = Purchase::factory()->count(3)->create();

        $response = $this->get(route('purchases.index'));

        $response
            ->assertOk()
            ->assertJsonStructure(['*' => [
                'id',
                'supplier' => ['id', 'name'],
                'deliveryDate',
                'paymentMethod' => ['id', 'name'],
                'paid',
                'purchaseItemsCount',
            ]])
            ->assertJson(function (AssertableJson $json) {
                $json->has(3);
            });
    }
    /* 
    #[Test]
    public function store_saves(): void
    {
        $full_name = $this->faker->word;
        $email = $this->faker->safeEmail;
        $phone_number = $this->faker->phoneNumber;
        $status = $this->faker->randomElement(['pending', 'in transit', 'delivered', 'delivery attempt', 'cancelled', 'return to sender']);
        $city = $this->faker->city;
        $payment_method_id = PaymentMethod::factory()->create()->id;
        $coupon_code_id = CouponCode::factory()->create()->id;
        $zip_code = $this->faker->word;
        $address = $this->faker->word;
        $delivery = $this->faker->boolean;

        $response = $this->post(route('purchases.store'), [
            'full_name' => $full_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'status' => $status,
            'city' => $city,
            'payment_method_id' => $payment_method_id,
            'zip_code' => $zip_code,
            'coupon_code_id' => $coupon_code_id,
            'address' => $address,
            'delivery' => $delivery,
            'purchase_items' => [
                [
                    'product_id' => Product::factory()->create()->id,
                    'quantity' => fake()->numberBetween(),
                ],
                [
                    'product_id' => Product::factory()->create()->id,
                    'quantity' => fake()->numberBetween(),
                ],
            ]
        ]);

        $purchases = Purchase::query()
            ->where('full_name', $full_name)
            ->where('email', $email)
            ->where('phone_number', $phone_number)
            ->where('status', $status)
            ->where('city', $city)
            ->where('payment_method_id', $payment_method_id)
            ->where('zip_code', $zip_code)
            ->where('coupon_code_id', $coupon_code_id)
            ->where('address', $address)
            ->where('delivery', $delivery)
            ->get();

        $this->assertCount(1, $purchases);

        $purchase = $purchases->first();

        $response->assertCreated();
    }
*/
    // #[Test]
    // public function show_behaves_as_expected(): void
    // {
    //     $purchase = Purchase::factory()->create();

    //     $response = $this->get(route('purchases.show', $purchase));

    //     $response->assertOk();
    //     $response->assertJsonStructure([
    //     'id',
    //     'paid',
    //     'deliveryDate',
    //     'supplier' => ['id', 'name'],
    //     'paymentMethod' => ['id', 'name'],
    //     'store' => ['id', 'store'],
    //     'purchaseItemsCount',
    // ]);
    // }

    /*
    #[Test]
    public function update_behaves_as_expected(): void
    {
        $purchase = Purchase::factory()->create();
        $full_name = $this->faker->word;
        $email = $this->faker->safeEmail;
        $phone_number = $this->faker->phoneNumber;
        $status = $this->faker->randomElement(['pending', 'in transit', 'delivered', 'delivery attempt', 'cancelled', 'return to sender']);
        $city = $this->faker->city;
        $payment_method_id = PaymentMethod::factory()->create()->id;
        $zip_code = $this->faker->word;
        $coupon_code_id = CouponCode::factory()->create()->id;
        $address = $this->faker->word;
        $delivery = $this->faker->boolean;

        $response = $this->put(route('purchases.update', $purchase), [
            'full_name' => $full_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'status' => $status,
            'city' => $city,
            'payment_method_id' => $payment_method_id,
            'zip_code' => $zip_code,
            'coupon_code_id' => $coupon_code_id,
            'address' => $address,
            'delivery' => $delivery,
        ]);

        $purchase->refresh();

        $response->assertNoContent();

        $this->assertEquals($full_name, $purchase->full_name);
        $this->assertEquals($email, $purchase->email);
        $this->assertEquals($phone_number, $purchase->phone_number);
        $this->assertEquals($status, $purchase->status);
        $this->assertEquals($city, $purchase->city);
        $this->assertEquals($payment_method_id, $purchase->payment_method_id);
        $this->assertEquals($zip_code, $purchase->zip_code);
        $this->assertEquals($coupon_code_id, $purchase->coupon_code_id);
        $this->assertEquals($address, $purchase->address);
        $this->assertEquals($delivery, $purchase->delivery);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $purchase = Purchase::factory()->create();

        $response = $this->delete(route('purchases.destroy', $purchase));

        $response->assertNoContent();

        $this->assertModelMissing($purchase);
    } */
}
