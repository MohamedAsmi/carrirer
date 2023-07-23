<?php

namespace App\Http\Service;

use App\Models\Setting;
use Yajra\DataTables\DataTables;


class SettingService
{
    public function settingListDatatable()
    {
        $settings = Setting::whereNull('parent_id')->get();
        return DataTables::of($settings)
            ->addColumn('key', function ($model) {
                return $model->key;
            })
            ->addColumn('value', function ($model) {
                return $model->value;
            })
            ->addColumn('application_level', function ($model) {
                return ($model->application_level == 1)? '<i>TRUE</i>' : '<i>FALSE</i>';
            })
            ->addColumn('actions', function ($model) {
                $html = '<a href="javascript:void(0)" class="load-modal "
                data-url="' . route('setting.edit', ['setting' => $model->id]) . '">
                Edit
            </a>&nbsp; | &nbsp;<a href="' . route('settings.child-setting', ['setting' => $model->id]) . '">
                    Edit Setting List
                </a>&nbsp; | &nbsp;';

                $html .= '
            <a href="javascript:void(0)" class="delete" title="Delete"
            data-url="' . route('setting.destroy', ['setting' => $model->id]) . '">
                Delete
            </a>';

                return $html;
            })
            ->rawColumns(['key', 'value', 'application_level', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }

    public function childSettingListDatatable($parentId)
    {
        $settings = Setting::where('parent_id', $parentId)->get();
        
        return DataTables::of($settings)
            ->addColumn('key', function ($model) {
                return $model->key;
            })
            ->addColumn('value', function ($model) {
                return $model->value;
            })
            ->addColumn('actions', function ($model) {
                $html = '<a href="javascript:void(0)" class="load-modal "
                data-url="' . route('settings.child-setting.edit', ['setting_parent' => $model->parent_id, 'setting' => $model->id]) . '">
                Edit
                </a>&nbsp; | &nbsp;';

                $html .= '<a href="javascript:void(0)" class="delete" title="Delete"
                data-url="' . route('setting.destroy', ['setting' => $model->id]) . '">
                    Delete
                </a>';

                return $html;
            })
            ->rawColumns(['key', 'value', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
