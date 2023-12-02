<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodPostRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentMethodController extends Controller
{
    public function index(Request $request): Response
    {
        $paymentMethods = PaymentMethod::query();

        $paymentMethods = $request->input("sortBy") === "oldest"
            ? $paymentMethods->oldest()
            : $paymentMethods->latest();

        return response()->make($paymentMethods->get());
    }

    public function store(PaymentMethodPostRequest $request): Response
    {
        $paymentMethod = PaymentMethod::create($request->validated());

        return response()->make($paymentMethod, Response::HTTP_CREATED);
    }

    public function update(PaymentMethodPostRequest $request, PaymentMethod $paymentMethod): Response
    {
        $paymentMethod->update($request->validated());

        return response()->make(status: Response::HTTP_NO_CONTENT);
    }

    public function destroy(PaymentMethod $paymentMethod): Response
    {
        $paymentMethod->delete();

        return response()->make(status: Response::HTTP_NO_CONTENT);
    }
}
