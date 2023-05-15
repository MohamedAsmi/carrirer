<?php

namespace App\Http\Helper\Service;

use App\Models\weightoption;
use Yajra\DataTables\DataTables;


class WeightoptionService
{
    public function WeightoptionListDatatable($parentId = null)
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
            data-url="' . route('weightoption.destroy', ['id' => $model->id]) . '">
                Delete
            </a>&nbsp; | &nbsp;
            <a href="javascript:void(0)" class="load-modal " title="Delete"
            data-url="' . route('weightoption.edit', ['id' => $model->id]) . '">
                Edit
            </a>';
            })
            ->rawColumns(['name', 'value', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }

   
}
