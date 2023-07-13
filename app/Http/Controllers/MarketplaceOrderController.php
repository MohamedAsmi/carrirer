<?php

namespace App\Http\Controllers;

use App\Http\Helper\MarketplaceHelper;
use App\Http\Helper\ResponseHelper;
use App\Models\MarketplaceOrder;
use App\Http\Requests\StoreMarketplaceOrderRequest;
use App\Http\Requests\UpdateMarketplaceOrderRequest;
use App\Jobs\SyncOrders;
use App\Models\JobTracking;
use App\Models\User;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MarketplaceOrderController extends Controller
{
    use ResponseHelper;
    public function __construct()
    {
    }

    public function index()
    {
        $orderSyncingStatus = JobTracking::getStatus(auth()->id(), SyncOrders::class);
        return view('marketplace.order.index', compact('orderSyncingStatus'));
    }
    
    public function list()
    {
        $marketplace = MarketplaceOrder::all();
        return DataTables::of($marketplace)
            ->addColumn('mp_order_id', function ($model) {
                return $model->mp_order_id;
            })
            ->addColumn('marketplace', function ($model) {
                $logoUrl = MarketplaceHelper::getMarketplaceLogoById($model->marketplace_id);
                $html = "<img width='75' src='$logoUrl' />";
                return $html;
            })
            ->addColumn('products', function ($model) {
                $products = unserialize($model->products);
                $productLines = [];
                $i = 1;
                foreach ($products as $product) {
                    $productLines[] = $i . ') ' . $product['name'] . ' x ' . $product['quantity'];
                    $i++;
                }
                return implode("<br>", $productLines);
            })
            ->addColumn('actions', function ($model) {

                return '<a href="javascript: void(0);" class="text-primary">Create Label</a>';
            })
            ->rawColumns(['marketplace', 'products', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }

    public function sync($marketplaceId = false)
    {
        try {
            $user = User::find(auth()->id());
            dispatch(new SyncOrders($user));
            return $this->response('success', 'Marketplace orders are being synced');
        } catch (Exception $e) {
            return $this->response('fail', '', [$e->getMessage()], 422);
        }
    }
    public function create()
    {
        //
    }
    public function store(StoreMarketplaceOrderRequest $request)
    {
        //
    }
    public function show(MarketplaceOrder $marketplaceOrder)
    {
        //
    }
    public function edit(MarketplaceOrder $marketplaceOrder)
    {
        //
    }
    public function update(UpdateMarketplaceOrderRequest $request, MarketplaceOrder $marketplaceOrder)
    {
        //
    }
    public function destroy(MarketplaceOrder $marketplaceOrder)
    {
        //
    }
}
