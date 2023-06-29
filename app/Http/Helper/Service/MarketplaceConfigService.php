<?php

namespace App\Http\Helper\Service;

use App\Models\Marketplace;
use Yajra\DataTables\DataTables;


class MarketplaceConfigService
{

    public function MarketplaceListDatatable()
    {
        $marketplace = Marketplace::all();
        return DataTables::of($marketplace)
            ->addColumn('name', function ($model) {
                return $model->name;
            })
            ->addColumn('config', function ($model) {
                return '<a href="javascript:void(0)" class="load-modal" data-toggle="modal" data-url="' . route('marketplace.config.config-form', ['maketplaceId' => $model->id]) . '">Configuration</a>';
            })
            ->addColumn('actions', function ($model) {

                $accessToken = (new UserService)->getUserSettingByKey(auth()->id(), $model->parent_setting_id, 'STORE_ACCESS_TOKEN');
                $isAccessTokenValid = false;
                if (!empty($accessToken)) {
                    $isAccessTokenValid = true; // TODO: need to verify if accestoken valid
                }
                if ($isAccessTokenValid) {
                    return '<span class="badge bg-success">
                                <i class="bx bx-check"></i> Connected
                        </span>';
                } else {
                    return '<a class="btn btn-outline-primary" disabled class="delete"
                    href="' . route('marketplace.' . $model->slug . '.setup') . '">
                            <i class="bx bx-plug"></i> Connect Store
                    </a>';
                }
            })
            ->rawColumns(['name', 'config', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
