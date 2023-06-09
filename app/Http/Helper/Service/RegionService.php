<?php

namespace App\Http\Helper\Service;

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
                return '<a href="javascript:void(0)" class="delete" title="Delete"
            data-url="' . route('region.destroy', ['region' => $model->id]) . '">
                <button type="button" class="btn btn-icon btn-outline-danger">
                    <i class="bx bx-trash-alt"></i>
                </button>
            </a>
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
