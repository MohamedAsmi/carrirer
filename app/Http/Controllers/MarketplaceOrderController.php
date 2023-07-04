<?php

namespace App\Http\Controllers;

use App\Helper\ShopifyHelper;
use App\Http\Helper\MarketplaceHelper;
use App\Http\Helper\Service\CustomerAddressService;
use App\Http\Helper\Service\OrderService;
use App\Models\MarketplaceOrder;
use App\Http\Requests\StoreMarketplaceOrderRequest;
use App\Http\Requests\UpdateMarketplaceOrderRequest;
use App\Jobs\Sync\SyncShopifyOrders;
use App\Models\CustomerAddress;
use App\Models\Marketplace;
use App\Models\User;
use App\Services\ShopifyAPI;
use Yajra\DataTables\Facades\DataTables;

class MarketplaceOrderController extends Controller
{
    private $orderService;
    private $customerAddress;

    public function __construct(
        OrderService $orderService,
        CustomerAddressService $customerAddress
    ) {
        $this->orderService = $orderService;
        $this->customerAddress = $customerAddress;
    }

    public function index()
    {
        return view('marketplace.order.index');
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
        // $user = User::find(auth()->id());
        // $baseUrl = ShopifyHelper::getStoreBaseUrl($user->id);
        // $accessToken = ShopifyHelper::getStoreAccessToken($user->id);
        // $shopifyApi = new ShopifyAPI($baseUrl);
        // $shopifyApi->setAccessToken($accessToken);
        // $orders = $shopifyApi->getOrders();


        // foreach ($orders as $order) {
        //     $formattedOrder = ShopifyHelper::getformattedOrder($order);
        //     $formattedOrder['user_id'] = $user->id;
        //     $orderId = $this->orderService->createOrder($formattedOrder);

        //     $shippingAddress = $order['shipping_address'];
        //     $formattedAddress = ShopifyHelper::getformattedAddress($shippingAddress);
        //     $formattedAddress['order_id'] = $orderId;
        //     $this->customerAddress->createAddress($formattedAddress);
        // }
        // dd($orders);
        $user = User::find(auth()->id());
        dispatch(new SyncShopifyOrders($user));
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
