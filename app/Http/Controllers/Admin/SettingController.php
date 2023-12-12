<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingUpdateRequest;
use App\Http\Resources\Admin\SettingResource;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    public function show(Setting $setting)
    {
        return response()->make(new SettingResource($setting));
    }

    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        $data = $request->validated();

        $setting->update($data);

        return response()->noContent();
    }
}
