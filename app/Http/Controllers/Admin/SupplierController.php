<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SupplierPostRequest;
use App\Http\Resources\Admin\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;

#[ApiResource('suppliers')]
class SupplierController extends Controller
{
    public function index(): Response
    {
        $suppliers = Supplier::all();

        return response(SupplierResource::collection($suppliers));
    }

    public function store(SupplierPostRequest $request): Response
    {
        $supplier = Supplier::create($request->validated());

        return response('', Response::HTTP_CREATED);
    }

    public function show(Supplier $supplier): Response
    {
        return response(new SupplierResource($supplier));
    }

    public function update(SupplierPostRequest $request, Supplier $supplier): Response
    {
        $supplier->update($request->validated());

        return response()->noContent();
    }

    public function destroy(Supplier $supplier): Response
    {
        $supplier->delete();

        return response()->noContent();
    }
}
