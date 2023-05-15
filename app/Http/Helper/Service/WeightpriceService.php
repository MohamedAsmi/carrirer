<?php

namespace App\Http\Helper\Service;

use App\Models\weightprice;
use Yajra\DataTables\DataTables;


class WeightpriceService
{
    public function WeightoptionListDatatable($parentId = null)
    {
        $settings = weightprice::join('weightoptions','weightprices.weightoption_id','weightoptions.id')->join('regions','weightprices.region_id','regions.id')->select('weightprices.*','regions.*','weightoptions.*','weightprices.id as id','regions.name as rname','weightoptions.name as wname')->get();

        return DataTables::of($settings)
            ->addColumn('region', function ($model) {
                return $model->rname;
            })
            ->addColumn('weightoption', function ($model) {
                return $model->wname;
            })
            ->addColumn('actions', function ($model) {
                return '
                <a href="javascript:void(0)" class="delete" title="Delete"
            data-url="' . route('weightprice.destroy', ['id' => $model->id]) . '">
                Delete
            </a>&nbsp; | &nbsp;
            <a href="javascript:void(0)" class="load-modal " title="Delete"
            data-url="' . route('weightprice.edit', ['id' => $model->id]) . '">
                Edit
            </a>';
            })
            ->rawColumns(['region', 'weightoption','actions'])
            ->addIndexColumn()
            ->make(true);
    }

   
}
