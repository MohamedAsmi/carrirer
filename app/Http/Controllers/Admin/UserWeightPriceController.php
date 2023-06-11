<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Helper\Service\WeightPriceService;
use App\Models\Region;
use App\Models\UserWeightPrice;
use App\Models\WeightOption;
use Illuminate\Http\Request;

class UserWeightPriceController extends BaseController
{
    protected $weightPriceService;

    public function __construct(WeightPriceService $weightPriceService)
    {
        $this->weightPriceService = $weightPriceService;
    }

    public function index()
    {
        return view('admin.user_weight_price.index');
    }

    public function list()
    {
        return $this->weightPriceService->WeightoptionListDatatable();
    }

    public function create()
    {
        $regions = Region::all();
        $weightOptions = WeightOption::all();
        return view('admin.weight_price.create', compact('regions', 'weightOptions'));
    }

    public function store(Request $request)
    {
        UserWeightPrice::create($request->all());
        return self::response('success', 'Successfully Setting Created!');
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
