<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReviewPostRequest;
use App\Http\Requests\Admin\ReviewStoreRequest;
use App\Http\Requests\Admin\ReviewUpdateRequest;
use App\Http\Resources\Admin\ReviewCollection;
use App\Http\Resources\Admin\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;

#[ApiResource('reviews')]
class ReviewController extends Controller
{
    public function index(): Response
    {
        $reviews = Review::all();

        return response(ReviewResource::collection($reviews));
    }

    public function store(ReviewPostRequest $request): Response
    {
        $review = Review::create($request->validated());

        return response(new ReviewResource($review), Response::HTTP_CREATED);
    }

    public function show(Review $review): Response
    {
        return response(new ReviewResource($review));
    }

    public function update(ReviewPostRequest $request, Review $review): Response
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
}
