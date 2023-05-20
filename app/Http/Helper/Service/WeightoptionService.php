<?php

namespace App\Http\Helper\Service;

use App\Models\weightoption;
use Yajra\DataTables\DataTables;


class WeightOptionService
{
    public function WeightOptionListDatatable($parentId = null)
    {
        $settings = weightoption::all();

        return DataTables::of($settings)
            ->addColumn('name', function ($model) {
                return $model->name;
            })
            ->addColumn('value', function ($model) {
                return $model->value;
            })
            ->addColumn('actions', function ($model) {
                return '
                <a href="javascript:void(0)" class="delete" title="Delete"
            data-url="' . route('weight-option.destroy', ['weight_option' => $model->id]) . '">
                Delete
            </a>&nbsp; | &nbsp;
            <a href="javascript:void(0)" class="load-modal " title="Delete"
            data-url="' . route('weight-option.edit', ['weight_option' => $model->id],) . '">
                Edit
            </a>';
            })
            ->rawColumns(['name', 'value', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }

   
}
