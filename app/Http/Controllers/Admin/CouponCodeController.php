<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CouponCodeResource;
use App\Models\CouponCode;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;

#[ApiResource('coupon-codes')]
class CouponCodeController extends Controller
{
    public function index(): Response
    {
        $couponCodes = CouponCode::all();

        return response(CouponCodeResource::collection($couponCodes));
    }

    public function store(): Response
    {
        $data = request()->validate([
            'code' => ['required', 'string', 'min:1', 'max:255'],
            'amount' => ['required', 'integer', 'min:0', 'max:100']
        ]);

        $couponCode = CouponCode::create($data);

        return response(new CouponCodeResource($couponCode), Response::HTTP_CREATED);
    }

    public function show(CouponCode $couponCode): Response
    {
        return response(new CouponCodeResource($couponCode));
    }

    public function update(CouponCode $couponCode): Response
    {
        $data = request()->validate([
            'code' => ['string', 'min:1', 'max:255'],
            'amount' => ['integer', 'min:0', 'max:100']
        ]);

        $couponCode->update($data);

        return response()->noContent();
    }

    public function destroy(CouponCode $couponCode): Response
    {
        $couponCode->delete();

        return response()->noContent();
    }
}
