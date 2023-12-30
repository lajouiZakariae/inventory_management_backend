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

/**
 * @group Products
 * @ApiResource Products 
 */
#[ApiResource('products')]
class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $products = Product::all();

        return response(ProductResource::collection($products));
    }

    /**
     * Store a newly created product in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(): Response
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $product = Product::create($data);

        return response('', Response::HTTP_CREATED);
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product): Response
    {
        return response(new ProductResource($product));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \App\Http\Requests\Admin\ProductUpdateRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product): Response
    {
        $data = $request->validated();

        $product->update($data);

        return response()->noContent();
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product): Response
    {
        $product->delete();

        return response()->noContent();
    }

    /**
     * Publish the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    #[Patch('/products/{product}/publish')]
    public function publish(Product $product): Response
    {
        $product->publish();
        return response()->noContent();
    }

    /**
     * Display a listing of products for a specific category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    #[Get('/categories/{category}/products')]
    public function categoryProducts(Category $category): Response
    {
        return response(ProductResource::collection($category->products));
    }

    /**
     * Display a listing of products for a specific store.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    #[Get('/stores/{store}/products')]
    public function storeProducts(Store $store): Response
    {
        return response(ProductResource::collection($store->products));
    }
}
