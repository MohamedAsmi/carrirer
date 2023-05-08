<?php

namespace App\Http\Helper\Service;
use App\Models\User;
use Yajra\DataTables\DataTables;


class UserService{

    public static function UserListDatatable(){
        $marks=User::all();
        return DataTables::of($marks)
        ->addColumn('name', function ($model) {

            return $model->first_name.' '.$model->last_name;
                    
        })
        ->addColumn('status', function ($model) {
            return User::findstatus($model->id);
        })
        ->addColumn('setting', function ($model) {

            return '';
                    
        })
        ->addColumn('actions', function ($model) {

            return '<a href="javascript:void(0)" class="delete" title="Delete"
            data-url="' . route('user.delete', ['id' => $model->id]) . '">
                <button type="button" class="btn btn-icon btn-outline-danger">
                    <i class="bx bx-trash-alt"></i>
                </button>
            </a>
            <a href="javascript:void(0)" class="load-modal " title="Delete"
            data-url="' . route('user.edit', ['id' => $model->id]) . '">
                <button type="button" class="btn btn-icon btn-outline-primary">
                    <i class="bx bx-edit"></i>
                </button>
            </a>
            
            ';
                    
        })
        ->rawColumns(['name','status','setting','actions'])
        ->addIndexColumn()
        ->make(true);
    }
}