<?php

namespace App\Http\Service;

use App\Models\WeightPrice;
use Yajra\DataTables\DataTables;


class WeightPriceService
{
    public function WeightOptionListDatatable($parentId = null)
    {
        $settings = WeightPrice::join('weight_options','weight_prices.weight_option_id','weight_options.id')->join('regions','weight_prices.region_id','regions.id')->select('weight_prices.*','regions.*','weight_options.*','weight_prices.id as id','regions.name as rname','weight_options.name as wname')->get();

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
            data-url="' . route('weight-price.destroy', ['weight_price' => $model->id]) . '">
                Delete
            </a>&nbsp; | &nbsp;
            <a href="javascript:void(0)" class="load-modal " title="Delete"
            data-url="' . route('weight-price.edit', ['weight_price' => $model->id]) . '">
                Edit
            </a>';
            })
            ->rawColumns(['region', 'weightoption','actions'])
            ->addIndexColumn()
            ->make(true);
    }

   
}
