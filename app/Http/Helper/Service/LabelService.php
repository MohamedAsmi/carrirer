<?php

namespace App\Http\Helper\Service;

use App\Models\Credit;
use App\Models\Label;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\DataTables;


class LabelService
{
    
 
    public function LabelDatatable($parentId = null)
    {
        $settings = Label::all();

        return DataTables::of($settings)
        ->addColumn('actions', function ($model) {
            return '<a href="javascript:void(0)" class="delete" title="Delete"
        data-url="' . route('label.delete', ['id' => $model->id]) . '">
            <button type="button" class="btn btn-icon btn-outline-danger">
                <i class="bx bx-trash-alt"></i>
            </button>
        </a>
        <a href="javascript:void(0)" class="load-modal " title="Edit"
        data-url="' . route('label.edit', ['id' => $model->id]) . '">
            <button type="button" class="btn btn-icon btn-outline-primary">
                <i class="bx bx-edit"></i>
            </button>
        </a>';
        })
        ->rawColumns(['actions'])
        ->addIndexColumn()
        ->make(true);
    }

    public static function saveCreditAmount($credit_amount,$total,$source_id){
        $credit = new Credit();
        $credit->credit_added = Carbon::now();
        $credit->credit_amount = $credit_amount;
        $credit->total = $total;
        $credit->source_id = $source_id;
        $credit->details = "Label Controll";
        $credit->addby = $source_id;
        $credit->addto = $source_id;
        $credit->save();
        return $credit;

    }
}
