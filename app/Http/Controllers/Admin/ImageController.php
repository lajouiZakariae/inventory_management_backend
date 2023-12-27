<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImagePostRequest;
use App\Http\Resources\Admin\ImageResource;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\RouteAttributes\Attributes\ApiResource;
use Spatie\RouteAttributes\Attributes\Get;

#[ApiResource('images')]
class ImageController extends Controller
{
    public function index(): Response
    {
        $image = Image::all();

        return response(ImageResource::collection($image));
    }

    public function store(ImagePostRequest $request): Response
    {
        $data = $request->validated();

        /** @var UploadedFile */
        $uploadedImage  = $request->validated('image');

        if ($uploadedImage !== null && !$uploadedImage->getError()) {
            $data['path'] = $uploadedImage->store('products', 'public');
        }

        $image = Image::create($data);

        return response(new ImageResource($image), Response::HTTP_CREATED);
    }

    public function show(Image $image): Response
    {
        return response(new ImageResource($image));
    }

    public function update(ImagePostRequest $request, Image $image): Response
    {
        $data = $request->validated();

        $image = $request->validated('image');

        if ($image !== null && !$image->getError()) {
            if ($image->path) {
                Storage::disk('public')->delete($image->path);
            }
        }

        $image->update($data);

        return response()->noContent();
    }

    public function destroy(Image $image): Response
    {
        Storage::disk('public')->delete($image->path);

        $image->delete();

        return response()->noContent();
    }

    #[Get('products/{product}/images')]
    public function productImages(Product $product): Response
    {
        return response(ImageResource::collection($product->images));
    }
}
