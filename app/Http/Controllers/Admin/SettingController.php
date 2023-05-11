<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Helper\Service\SettingService;
use App\Http\Requests\Admin\Setting\CreateSettingRequest;
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function showChildSettings($parent_id)
    {
        return view('admin.setting.child_setting.index', ['parent_id', $parent_id]);
    }

    public function listChildSettings($setting)
    {
        return $this->settingService->settingListDatatable($setting);
    }

    public function createChildSetting()
    {
    }
    public function storeChildSetting()
    {
    }
    public function editChildSetting()
    {
    }
    public function updateChildSetting()
    {
    }
    public function destroyChildSetting()
    {
    }
}
