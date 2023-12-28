<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('orders/{order}')]
#[ApiResource('order-items')]
class OrderItemController extends Controller
{
    public function index(Order $order): Response
    {
        $orderItems = $order->orderItems;

        return response($orderItems);
    }

    public function store(Order $order): Response
    {
        $data = request()->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
        ]);

        $orderItem = OrderItem::create($data);

        return response();
    }

    // public function show(Request $request, OrderItem $orderItem): Response
    // {
    //     return new OrderItemResource($orderItem);
    // }

    // public function update(OrderItemUpdateRequest $request, OrderItem $orderItem): Response
    // {
    //     $orderItem->update($request->validated());

    //     return new OrderItemResource($orderItem);
    // }

    // public function destroy(Request $request, OrderItem $orderItem): Response
    // {
    //     $orderItem->delete();

    //     return response()->noContent();
    // }
}
