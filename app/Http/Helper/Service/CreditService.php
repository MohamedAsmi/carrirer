<?php

namespace App\Http\Helper\Service;

use App\Models\Credit;
use App\Models\User;
use Yajra\DataTables\DataTables;


class CreditService
{
    public function CreditDatatable($parentId = null)
    {
        $settings = Credit::all();

        return DataTables::of($settings)
        ->addColumn('credit_added', function ($model) {
            return date('Y-m-d H:i:s', strtotime($model->credit_added));
        })
        ->addColumn('addby', function ($model) {
            $user =User::findById($model->addby);
            return $user->first_name. ' '. $user->last_name;
        })
        ->addColumn('addto', function ($model) {
            $user =User::findById($model->addto);
            return $user->first_name. ' '. $user->last_name;
        })
     
        ->rawColumns(['addby','addto'])
        ->addIndexColumn()
        ->make(true);
    }

   
}
