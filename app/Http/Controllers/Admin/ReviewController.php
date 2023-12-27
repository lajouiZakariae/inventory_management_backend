<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReviewStoreRequest;
use App\Http\Requests\Admin\ReviewUpdateRequest;
use App\Http\Resources\Admin\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;
use Spatie\RouteAttributes\Attributes\Get;

#[ApiResource('reviews')]
class ReviewController extends Controller
{
    public function index(): Response
    {
        $reviews = Review::all();

        return response(ReviewResource::collection($reviews));
    }

    public function store(ReviewStoreRequest $request): Response
    {
        $review = Review::create($request->validated());

        return response(new ReviewResource($review), Response::HTTP_CREATED);
    }

    public function show(Review $review): Response
    {
        return response(new ReviewResource($review));
    }

    public function update(ReviewUpdateRequest $request, Review $review): Response
    {
        $data = $request->validated();

        $review->update($data);

        return response()->noContent();
    }

    public function destroy(Review $review): Response
    {
        $review->delete();

        return response()->noContent();
    }

    #[Get('/products/{product}/reviews')]
    public function productReviews(Product $product): Response
    {
        return response(ReviewResource::collection($product->reviews));
    }
}
