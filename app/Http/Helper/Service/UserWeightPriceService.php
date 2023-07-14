<?php

namespace App\Http\Helper\Service;

use App\Models\UserWeightPrice;
use App\Models\WeightPrice;
use Yajra\DataTables\DataTables;


class UserWeightPriceService
{
    public function UserWeightPriceListDatatable($parentId = null)
    {

        $settings = UserWeightPrice::join('regions','regions.id','user_weight_prices.region_id')->join('weight_options','weight_options.id','user_weight_prices.weight_option_id')->join('users','users.id','user_weight_prices.user_id')->select('users.*','user_weight_prices.credit','weight_options.name as wname','regions.name as rname')->get();

        $count = 1;
        return DataTables::of($settings)
        ->addColumn('id', function ($model) use (&$count){
            return $count++;
        })
        ->addColumn('name', function ($model) {
            return $model->first_name.' '.$model->last_name;
        })
        ->addColumn('actions', function ($model) {
            return '
            <a href="javascript:void(0)" class="delete" title="Delete"
            data-url="' . route('user-weight-price.delete', ['id' => $model->id]) . '">
                Delete
            </a>&nbsp; | &nbsp;
            <a href="javascript:void(0)" class="load-modal " title="Delete"
            data-url="' . route('user-weight-price.edit', ['id' => $model->id]) . '">
                Edit
            </a>';
        })
        ->rawColumns(['id','name','actions'])
        ->addIndexColumn()
        ->make(true);
    }

   
}
