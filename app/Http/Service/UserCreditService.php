<?php

namespace App\Http\Helper\Service;

use App\Models\Credit;
use App\Models\Source;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


class UserCreditService
{
    public function CreditDatatable($user_id = null)
    {

        
    
        $results = Credit::where('addto',Auth::user()->id)->get();
       
        
        return DataTables::of($results)
        ->addColumn('source', function ($model) {
            $source = Source::findById($model->source_id);
            return $source->name;
        })
        ->addColumn('credit_added', function ($model) {
            return date('Y-m-d H:i:s', strtotime($model->credit_added));
        })
    
        ->rawColumns(['source'])
        ->addIndexColumn()
        ->make(true);
    }

   
}
