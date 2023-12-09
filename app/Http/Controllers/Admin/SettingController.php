<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingStoreRequest;
use App\Http\Requests\Admin\SettingUpdateRequest;
use App\Http\Resources\Admin\SettingCollection;
use App\Http\Resources\Admin\SettingResource;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    public function index(Request $request): Response
    {
        $settings = Setting::query()->when(
            in_array($request->input('platform', 'desktop'), ['desktop', 'web_client', 'web_admin']),
            fn (Builder $q) => $q->where('platform', $request->input('platform', 'desktop'))
        )->get();

        return response()->make($settings);
    }

    // public function update(SettingUpdateRequest $request, Setting $setting): Response
    // {
    //     $setting->update($request->validated());

    //     return new SettingResource($setting);
    // }

}
