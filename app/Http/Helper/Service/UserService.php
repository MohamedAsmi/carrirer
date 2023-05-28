<?php

namespace App\Http\Helper\Service;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class UserService
{

    public function UserListDatatable()
    {
        $marks = User::all();
        return DataTables::of($marks)
            ->addColumn('name', function ($model) {

                return $model->first_name . ' ' . $model->last_name;
            })
            ->addColumn('status', function ($model) {
                return self::getUserStatus($model->id);
            })
            ->addColumn('setting', function ($model) {
                // return "";
                return '<a href="' . route('userSetting', ['user' => $model->id]) . '">Setting List</a>';
            })
            ->addColumn('actions', function ($model) {

                return '<a href="javascript:void(0)" class="delete" title="Delete"
            data-url="' . route('user.delete', ['id' => $model->id]) . '">
                <button type="button" class="btn btn-icon btn-outline-danger">
                    <i class="bx bx-trash-alt"></i>
                </button>
            </a>
            <a href="javascript:void(0)" class="load-modal " title="Edit"
            data-url="' . route('user.edit', ['id' => $model->id]) . '">
                <button type="button" class="btn btn-icon btn-outline-primary">
                    <i class="bx bx-edit"></i>
                </button>
            </a>';
            })
            ->rawColumns(['name', 'status', 'setting', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getUserStatus($id)
    {
        $userRole = User::findById($id);
        if ($userRole->status == User::USER_ACTIVE) {
            return 'Active';
        } elseif ($userRole->status == User::USER_NOT_ACTIVE) {
            return 'Inactive';
        }
    }

    public static function getUserSettings($userId, $parentSettingId)
    {
        $userSetting = DB::table('settings as s')
            ->leftJoin('user_setting as us', function ($join) use ($userId) {
                $join->on('s.id', '=', 'us.setting_id')
                    ->where('us.user_id', '=', $userId)
                    ->where('s.application_level', '!=', 1);
            })
            ->where('s.parent_id', $parentSettingId)
            ->select(
                's.id as setting_id',
                's.parent_id as setting_parent_id',
                's.value as setting_desc',
                'us.value as setting_value'
            )
            ->get();
        return $userSetting;
    }
}
