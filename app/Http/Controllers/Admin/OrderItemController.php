<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderItemStoreRequest;
use App\Http\Requests\Admin\OrderItemUpdateRequest;
use App\Http\Resources\Admin\OrderItemCollection;
use App\Http\Resources\Admin\OrderItemResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('orders/{order}')]
#[ApiResource('order-items')]
class OrderItemController extends Controller
{
    public function index(Request $request, Order $order): Response
    {
        $orderItems = $order->orderItems;

        return response($orderItems);
    }

    // public function store(OrderItemStoreRequest $request): Response
    // {
    //     $orderItem = OrderItem::create($request->validated());

    //     return new OrderItemResource($orderItem);
    // }

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
