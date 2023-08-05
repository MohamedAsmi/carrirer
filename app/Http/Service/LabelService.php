<?php

namespace App\Http\Service;

use App\Models\Label;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    public function createLabel($userId, $labelData)
    {
        DB::transaction(function () use ($userId, $labelData) {
            User::find($userId)->labels()->create($labelData);
        });
    }
}
