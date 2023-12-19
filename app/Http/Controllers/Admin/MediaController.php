<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaPostRequest;
use App\Http\Resources\Admin\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MediaController extends Controller
{
    public function index(Request $request): Response
    {
        $media = Media::all();

        return response(MediaResource::collection($media));
    }

    public function store(MediaPostRequest $request): Response
    {
        $Media = Media::create($request->validated());

        return response(status: 404);
    }

    public function show(Request $request, Media $Media): Response
    {
        return response(new MediaResource($Media));
    }

    public function update(MediaPostRequest $request, Media $Media)
    {
        $Media->update($request->validated());

        return new MediaResource($Media);
    }

    public function destroy(Request $request, Media $Media): Response
    {
        $Media->delete();

        return response()->noContent();
    }
}
