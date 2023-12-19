<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductPostRequest;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller {
    public function index(): Response {
        $products = Product::all();

        return response(ProductResource::collection($products));
    }

    public function store(ProductPostRequest $request): Response {
        $product = Product::create($request->validated());

        return response('', Response::HTTP_CREATED);
    }

    public function show(Request $request, Product $product): Response {
        return response(new ProductResource($product));
    }

    public function update(ProductPostRequest $request, Product $product): Response {
        $product->update($request->validated());

        return response()->noContent();
    }

    public function destroy(Product $product): Response {
        $product->delete();

        return response()->noContent();
    }
}
