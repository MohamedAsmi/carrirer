<?php

namespace App\Http\Service;

use App\Models\Region;
use Yajra\DataTables\DataTables;


class RegionService
{
    public function RegionListDatatable()
    {
        $regions = Region::all();
        return DataTables::of($regions)
            ->addColumn('code', function ($model) {
                return $model->code;
            })
            ->addColumn('name', function ($model) {
                return $model->name;
            })
            ->addColumn('actions', function ($model) {
                return '
            <a href="javascript:void(0)" class="load-modal " title="Edit"
            data-url="' . route('region.edit', ['region' => $model->id]) . '">
                <button type="button" class="btn btn-icon btn-outline-primary">
                    <i class="bx bx-edit"></i>
                </button>
            </a>';
            })
            ->rawColumns(['code', 'name', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
