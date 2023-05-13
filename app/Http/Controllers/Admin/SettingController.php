<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Helper\Service\SettingService;
use App\Http\Requests\Admin\Setting\CreateChildSettingRequest;
use App\Http\Requests\Admin\Setting\CreateSettingRequest;
use App\Http\Requests\Admin\Setting\UpdateChildSettingRequest;
use App\Http\Requests\Admin\Setting\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        return view('admin.setting.index');
    }

    public function list()
    {
        return $this->settingService->settingListDatatable();
    }

    public function create()
    {
        return view('admin.setting.create');
    }

    public function store(CreateSettingRequest $request)
    {
        $validatedData = $request->validated();
        Setting::create($validatedData);
        return self::response('success', 'Successfully Setting Created!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('admin.setting.edit', compact('setting'));
        return view('admin.setting.edit');
    }

    public function update(UpdateSettingRequest $request, $id)
    {
        $validatedData = $request->validated();
        $setting = Setting::findOrFail($id);
        $setting->update($validatedData);
        return self::response('success', 'Successfully User Updated!');
    }

    public function destroy($id)
    {
        $resource = Setting::findOrFail($id);
        $resource->delete();
        return self::response('success', 'Successfully User Updated!');
    }

    public function showChildSettings($setting)
    {
        $parent_setting = Setting::findOrFail($setting);
        return view('admin.setting.child_setting.index', ['parent_setting' => $parent_setting]);
    }

    public function listChildSettings($setting)
    {
        return $this->settingService->childSettingListDatatable($setting);
    }

    public function createChildSetting($parent_id)
    {
        $parent_setting = Setting::findOrFail($parent_id);
        return view('admin.setting.child_setting.create', ['parent_setting' => $parent_setting]);
    }
    public function storeChildSetting(CreateChildSettingRequest $request)
    {
        $validatedData = $request->validated();
        Setting::create($validatedData);
        return self::response('success', 'Successfully Setting Created!');
    }

    public function editChildSetting($setting_parent, $setting)
    {
        $parent_setting = Setting::findOrFail($setting_parent);
        $setting = Setting::find($setting);
        return view('admin.setting.child_setting.edit', compact('setting', 'parent_setting'));
        return view('admin.setting.edit');
    }

    public function updateChildSetting(UpdateChildSettingRequest $request, $parent_id, $setting_id)
    {
        $validatedData = $request->validated();
        $setting = Setting::findOrFail($setting_id);
        $setting->update($validatedData);
        return self::response('success', 'Successfully User Updated!');
    }
    public function destroyChildSetting()
    {
    }
}
