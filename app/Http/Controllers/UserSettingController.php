<?php

namespace App\Http\Controllers;

use App\Http\Helper\ResponseHelper;
use App\Http\Helper\Service\UserService;
use App\Http\Requests\Admin\UserSetting\UpdateUserSettingRequest as UserSettingUpdateUserSettingRequest;
use App\Models\Setting;
use App\Models\User;

class UserSettingController extends BaseController
{
    public function index(User $user)
    {
        $parentSettings = Setting::whereNull('parent_id')->where('application_level', '!=', 1)->get();
        return view('admin.user_setting.index', compact('parentSettings', 'user'));
    }

    public function getChildSettingList($parent_setting_id)
    {
        $userSettings = UserService::getUserSettings(auth()->id(), $parent_setting_id);
        return $this->response('success', '', [], 200, compact('userSettings'));
    }

    public function update(UserSettingUpdateUserSettingRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $user = User::find($validatedData['user_id']);

            $data = [];
            for ($i = 0; $i < count($validatedData['setting_id']); $i++) {
                $settingId = $validatedData['setting_id'][$i];
                $settingValue = $validatedData['setting_val'][$i];
                $settingParentId = $validatedData['setting_parent_id'][$i];

                $data[$settingId] = [
                    'value' => $settingValue,
                    'setting_parent_id' => $settingParentId
                ];
            }

            $user->settings()->syncWithoutDetaching($data);
            return $this->response('success', 'User settings updated successfully', [], 200);

        } catch (\Exception $e) {
            return $this->response('error', $e->getMessage(), [], 422);
        }
    }
}
