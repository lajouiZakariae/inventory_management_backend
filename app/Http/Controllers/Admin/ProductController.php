<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Patch;

#[ApiResource('products')]
class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::all();

        return response(ProductResource::collection($products));
    }

    public function store(): Response
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $product = Product::create($data);

        return response('', Response::HTTP_CREATED);
    }

    public function show(Request $request, Product $product): Response
    {
        return response(new ProductResource($product));
    }

    public function update(ProductUpdateRequest $request, Product $product): Response
    {
        $data = $request->validated();

        $product->update($data);

        return response()->noContent();
    }

    public function destroy(Product $product): Response
    {
        $product->delete();

        return response()->noContent();
    }

    #[Patch('/products/{product}/publish')]
    function publish(Product $product): Response
    {
        $product->publish();
        return response()->noContent();
    }

    #[Get('/categories/{category}/products')]
    public function categoryProducts(Category $category): Response
    {
        return response(ProductResource::collection($category->products));
    }

    #[Get('/stores/{store}/products')]
    public function storeProducts(Store $store): Response
    {
        return response(ProductResource::collection($store->products));
    }
}
