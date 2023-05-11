<?php

namespace App\Http\Helper\Service;

use App\Models\Setting;
use Yajra\DataTables\DataTables;


class SettingService
{
    public function settingListDatatable($parentId = null)
    {
        $settings = $this->getSettings($parentId);

        return DataTables::of($settings)
            ->addColumn('name', function ($model) {
                return $model->name;
            })
            ->addColumn('value', function ($model) {
                return $model->value;
            })
            ->addColumn('actions', function ($model) {
                return '<a href="' . route('settings.child-setting', ['setting' => 'fdsfds']) . '">
                    Edit Setting List
                </a>&nbsp; | &nbsp;
                <a href="javascript:void(0)" class="delete" title="Delete"
            data-url="' . route('setting.destroy', ['setting' => $model->id]) . '">
                Edit
            </a>&nbsp; | &nbsp;
            <a href="javascript:void(0)" class="load-modal " title="Delete"
            data-url="' . route('setting.edit', ['setting' => $model->id]) . '">
                Delete
            </a>';
            })
            ->rawColumns(['name', 'value', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getSettings($parentId)
    {
        if ($parentId == null) {
            return Setting::whereNull('parent_id')->orderBy('name')->get();
        } else {
            return Setting::where('parent_id', $parentId)->orderBy('name')->get();
        }
    }
}
