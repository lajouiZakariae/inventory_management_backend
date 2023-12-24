<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Resources\Admin\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;

#[ApiResource('stores')]
class StoreController extends Controller {
    public function index(): Response {
        $stores = Store::query();

        $stores = request()->input('sortBy') === 'oldest'
            ? $stores->oldest()
            : $stores->latest();

        return response()->make(StoreResource::collection($stores->get()));
    }


    public function show(Store $store): Response {
        return response()->make(new StoreResource($store));
    }

    public function store(StorePostRequest $request): Response {
        $store = Store::create($request->validated());

        return response()->make($store, Response::HTTP_CREATED);
    }

    public function update(StorePostRequest $request, Store $store): Response {
        $store->update($request->validated());

        return response()->noContent();
    }

    public function destroy(Store $store): Response {
        $store->delete();

        return response()->noContent();
    }
}
