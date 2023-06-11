<?php

namespace App\Http\Helper\Service;

use App\Models\UserWeightPrice;
use App\Models\WeightPrice;
use Yajra\DataTables\DataTables;


class UserWeightPriceService
{
    public function weightPriceListDatatable($userId)
    {
        $settings = UserWeightPrice::join('weight_options', 'user_weight_prices.weight_option_id', 'weight_options.id')
            ->join('regions', 'user_weight_prices.region_id', 'regions.id')
            ->join('users', 'user_weight_prices.user_id', 'users.id')
            ->select('user_weight_prices.*', 'regions.*', 'weight_options.*', 'user_weight_prices.id as id', 'regions.name as rname', 'weight_options.name as wname')
            ->where('users.id', $userId)->get();

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
            ->rawColumns(['region', 'weightoption', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
