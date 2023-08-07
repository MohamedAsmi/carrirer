<?php

namespace App\Http\Service;

use App\Models\Credit;
use App\Models\Source;
use App\Models\User;
use Yajra\DataTables\DataTables;


class CreditService
{
    public function CreditDatatable($user_id = null,$min = null,$max = null)
    {

        if ($min && $max) {
            $minDate = date('Y-m-d H:i:s', strtotime($min));
            $maxDate = date('Y-m-d H:i:s', strtotime($max));
            $settings = Credit::whereBetween('credit_added', [$minDate, $maxDate]);
        }
        
        if ($user_id) {
            if (isset($settings)) {
                $settings->where('addto', $user_id);
            } else {
                $settings = Credit::where('addto', $user_id);
            }
        }
        
        if (isset($settings)) {
            $results = $settings->orderBy('credit_added','DESC')->get();
        } else {
            // If neither date range nor user ID is set, you might want to handle it accordingly.
            // For example, fetch all records without any filtering.
            $results = Credit::orderBy('credit_added','DESC')->get();
        }

        return DataTables::of($results)
        ->addColumn('source', function ($model) {
            $source = Source::findById($model->source_id);
            return $source->name ?? 'Administration';
        })
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
     
        ->rawColumns(['source','addby','addto'])
        ->addIndexColumn()
        ->make(true);
    }

   
}
