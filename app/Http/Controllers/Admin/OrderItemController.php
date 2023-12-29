<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderItemResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;
use Spatie\RouteAttributes\Attributes\Patch;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('orders/{order}')]
#[ApiResource('order-items')]
class OrderItemController extends Controller
{
    public function index(Order $order): Response
    {
        $orderItems = $order->orderItems;

        return response(OrderItemResource::collection($orderItems));
    }

    public function store(Order $order): Response
    {
        $data = request()->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
        ]);

        $orderItem = new OrderItem($data);

        $order->orderItems()->save($orderItem);

        return response('', Response::HTTP_CREATED);
    }

    public function show($order, OrderItem $orderItem): Response
    {
        return response(new OrderItemResource($orderItem));
    }

    public function update($order, OrderItem $orderItem): Response
    {
        $data = request()->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
        ]);

        $orderItem->update($data);

        return response()->noContent();
    }

    public function destroy($order, OrderItem $orderItem): Response
    {
        $orderItem->delete();

        return response()->noContent();
    }

    #[Patch('order-items/{order_item}/increment-quantity', 'order-items.increment-quantity')]
    public function incrementQuantity($order, OrderItem $orderItem): Response
    {
        $orderItem->quantity++;

        $orderItem->save();

        return response()->noContent();
    }

    #[Patch('order-items/{order_item}/decrement-quantity', 'order-items.decrement-quantity')]
    public function decrementQuantity($order, OrderItem $orderItem): Response
    {
        $orderItem->quantity--;

        $orderItem->save();

        return response()->noContent();
    }
}
