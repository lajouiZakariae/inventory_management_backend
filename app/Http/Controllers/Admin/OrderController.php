<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderStoreRequest;
use App\Http\Requests\Admin\OrderUpdateRequest;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;

/**
 * @group Orders
 */
#[ApiResource('orders')]
class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $orders = Order::query()->withCount('orderItems')->get(['id', 'email', 'status', 'delivery', 'created_at']);

        return response(OrderResource::collection($orders));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \App\Http\Requests\Admin\OrderStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request): Response
    {
        $data = $request->validated();

        $order = Order::create($data);

        return response($order, Response::HTTP_CREATED);
    }

    /**
     * Display the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order): Response
    {
        $orderData = $order->load([
            'paymentMethod'
        ]);

        return response(new OrderResource($orderData));
    }

    /**
     * Update the specified order in storage.
     *
     * @param  \App\Http\Requests\Admin\OrderUpdateRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order): Response
    {
        $data = $request->validated();

        $order->update($data);

        return response()->noContent();
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order): Response
    {
        $order->delete();

        return response()->noContent();
    }
}
