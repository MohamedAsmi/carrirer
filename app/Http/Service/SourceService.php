<?php

namespace App\Http\Service;

use App\Models\Credit;
use App\Models\Source;
use App\Models\User;
use Yajra\DataTables\DataTables;


class SourceService
{
    public function SourceDatatable($parentId = null)
    {
        $settings = Source::all();
        return DataTables::of($settings)
        ->addIndexColumn()
        ->make(true);
    }

   
}
