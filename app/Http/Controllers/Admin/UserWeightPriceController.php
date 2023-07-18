<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Helper\Service\UserWeightPriceService;
use App\Models\Region;
use App\Models\User;
use App\Models\UserWeightPrice;
use App\Models\WeightOption;
use App\Models\WeightPrice;
use Illuminate\Http\Request;

class UserWeightPriceController extends BaseController
{
    protected $userweightpriceservice;

    public function __construct(UserWeightPriceService $userweightpriceservice)
    {
        $this->userweightpriceservice = $userweightpriceservice;
    }

    public function index()
    {
        return view('admin.user_weight_price.index');
    }

    public function list()
    {
        return $this->userweightpriceservice->UserWeightPriceListDatatable();
    }

    public function create()
    {
        $regions = Region::all();
        $weightOptions = WeightPrice::select('weight_options.*')
        ->join('weight_options', 'weight_prices.weight_option_id', '=', 'weight_options.id')
        ->distinct('weight_options.id')
        ->get();
        $users = User::all();
        return view('admin.user_weight_price.create', compact('regions', 'weightOptions','users'));
    }

    public function store(Request $request)
    {
       $UserWeightPrice = UserWeightPrice::where('region_id',$request->region_id)->Where('weight_option_id',$request->weight_option_id)->Where('user_id',$request->user_id)->get();
    //    dd(count($UserWeightPrice));
        if(count($UserWeightPrice) > 0){
            return self::response('error', 'Already Data Inserted!');
        }else{
            UserWeightPrice::create($request->all());
            return self::response('success', 'Successfully Setting Created!');
        }
        
    }

    public function show(UserWeightPrice $weightPrice)
    {
        //
    }

    public function edit(UserWeightPrice $weightPrice)
    {
        $regions = Region::all();
        $weightOptions = weightoption::all();
        return view('admin.weight_price.edit', compact('regions', 'weightOptions', 'weightPrice'));
    }

    public function update(Request $request, $id)
    {
        $weightPrice = UserWeightPrice::find($id);
        $weightPrice->update($request->all());
        return self::response('success', 'Successfully Setting Created!');
    }

    public function destroy(UserWeightPrice $weightPrice)
    {
        $weightPrice->delete();
        return self::response('success', 'Successfully WeightPrice Deleted!!');
    }
}
