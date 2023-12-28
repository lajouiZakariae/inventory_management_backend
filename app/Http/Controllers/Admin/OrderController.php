<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderStoreRequest;
use App\Http\Requests\Admin\OrderUpdateRequest;
use App\Http\Resources\Admin\OrderCollection;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;

#[ApiResource('orders')]
class OrderController extends Controller
{
    public function index(): Response
    {
        $orders = Order::query()->withCount('orderItems')->get(['id', 'email', 'status', 'delivery', 'created_at']);

        return response(OrderResource::collection($orders));
    }

    // public function store(OrderStoreRequest $request): Response
    // {
    //     $data = $request->validated();

    //     $order = Order::create($data);

    //     return response('', Response::HTTP_ACCEPTED);
    // }

    public function show(Order $order): Response
    {
        $orderData = $order->load([
            'paymentMethod'
        ]);

        return response(new OrderResource($orderData));
    }

    // public function update(OrderUpdateRequest $request, Order $order): Response
    // {
    //     $data = $request->validated();

    //     $order->update($data);

    //     return response()->noContent();
    // }

    public function destroy(Order $order): Response
    {
        $order->delete();

        return response()->noContent();
    }
}
