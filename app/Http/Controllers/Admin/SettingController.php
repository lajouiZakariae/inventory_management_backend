<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingUpdateRequest;
use App\Http\Resources\Admin\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\ApiResource;

/**
 * @group Settings
 */
#[ApiResource('settings', only: ['show', 'update'])]
class SettingController extends Controller
{
    /**
     * Display the specified setting.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting): Response
    {
        return response(new SettingResource($setting));
    }

    /**
     * Update the specified setting in storage.
     *
     * @param  \App\Http\Requests\Admin\SettingUpdateRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        $data = $request->validated();

        $setting->update(['settings_value' => $data]);

        return response()->noContent();
    }
}
