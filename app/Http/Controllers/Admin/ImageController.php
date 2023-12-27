<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImagePostRequest;
use App\Http\Resources\Admin\ImageResource;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
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

    private function extractData(Image $image, ImagePostRequest $request): array
    {
        $data = $request->validated();

        /** @var UploadedFile */
        $uploaded_image  = $request->validated('image');

        if ($uploaded_image === null || $uploaded_image->getError()) {
            return $data;
        }

        /* delete image on upload */
        if ($image->path) {
            Storage::disk('public')->delete($image->path);
        }

        $data['path'] = $uploaded_image->store('products', 'public');

        return $data;
    }

    public function store(ImagePostRequest $request): Response
    {
        $data = $this->extractData(new Image(), $request);

        $image = Image::create($data);

        return response(new ImageResource($image), Response::HTTP_CREATED);
    }

    public function show(Image $image): Response
    {
        return response(new ImageResource($image));
    }

    public function update(ImagePostRequest $request, Image $image) //: Response
    {
        $data = $this->extractData($image, $request);

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
