<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Helper\ResponseHelper;
use App\Http\Helper\Service\MarketplaceConfigService;
use App\Http\Helper\Service\UserService;
use App\Http\Requests\Marketplace\StoreMarketplaceConfig;
use App\Models\Marketplace;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MarketplaceConfigController extends Controller
{
    use ResponseHelper;

    protected $marketplaceService;

    public function __construct(MarketplaceConfigService $marketplaceService)
    {
        $this->marketplaceService = $marketplaceService;
    }
    public function index()
    {
        return view('marketplace.config.index');
    }

    public function list()
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

    public function show($id)
    {
        //
    }

    public function create()
    {
        //
    }

    public function configForm($marketplaceId)
    {
        $marketplace = Marketplace::find($marketplaceId);
        $marketplaceUserSettings = Helper::getMarketplaceSettings($marketplaceId);
        return view('marketplace.config.config_form', compact('marketplace', 'marketplaceUserSettings'));
    }

    public function update(StoreMarketplaceConfig $request)
    {
        try {
            $requestData = $request->except('_token');
            $user = User::find(auth()->id());

            $data = [];
            for ($i = 0; $i < count($requestData['setting_id']); $i++) {
                $settingId = $requestData['setting_id'][$i];
                $settingValue = $requestData['setting_val'][$i];
                $settingParentId = $requestData['setting_parent_id'][$i];

                $data[$settingId] = [
                    'value' => $settingValue,
                    'setting_parent_id' => $settingParentId
                ];
            }

            $user->settings()->syncWithoutDetaching($data);
            return $this->response('success', 'User settings updated successfully', [], 200);
        } catch (\Exception $e) {
            return $this->response('error', $e->getMessage(), [], 422);
        }
    }

    public function getSettings($marketplaceId)
    {
        $marketplaceUserSettings = Helper::getMarketplaceSettings($marketplaceId);
        return $this->response('success', '', [], 200, $marketplaceUserSettings);
    }
}
