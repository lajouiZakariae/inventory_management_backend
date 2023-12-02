<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    public function index(Request $request): Response
    {
        $stores = Store::query();

        $stores = $request->input("sortBy") === "oldest"
            ? $stores->oldest()
            : $stores->latest();

        return response()->make($stores->get());
    }

    public function store(StorePostRequest $request): Response
    {
        $store = Store::create($request->validated());

        return response()->make($store, Response::HTTP_CREATED);
    }

    public function update(StorePostRequest $request, Store $store): Response
    {
        $store->update($request->validated());

        return response()->make($store);
    }

    public function destroy(Request $request, Store $store): Response
    {
        $store->delete();

        return response()->noContent();
    }
}
