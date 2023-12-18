<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponCodePostRequest;
use App\Http\Resources\Admin\CouponCodeCollection;
use App\Http\Resources\Admin\CouponCodeResource;
use App\Models\CouponCode;
use Illuminate\Http\Response;

class CouponCodeController extends Controller {
    public function index(): Response {
        $couponCodes = CouponCode::all();

        return response(CouponCodeResource::collection($couponCodes));
    }

    public function store(CouponCodePostRequest $request): Response {
        $couponCode = CouponCode::create($request->validated());

        return response(new CouponCodeResource($couponCode), Response::HTTP_CREATED);
    }

    public function show(CouponCode $couponCode): Response {
        return response(new CouponCodeResource($couponCode));
    }

    public function update(CouponCodePostRequest $request, CouponCode $couponCode): Response {
        $couponCode->update($request->validated());

        return response()->noContent();
    }

    public function destroy(CouponCode $couponCode): Response {
        $couponCode->delete();

        return response()->noContent();
    }
}
