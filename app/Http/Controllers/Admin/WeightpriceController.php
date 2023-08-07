<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Service\WeightPriceService;
use App\Models\WeightPrice;
use App\Http\Requests\Admin\weightprice\StoreWeightPriceRequest;
use App\Http\Requests\Admin\weightprice\UpdateWeightPriceRequest;
use App\Models\Region;
use App\Models\WeightOption;

class WeightPriceController extends BaseController
{
    protected $weightPriceService;

    public function __construct(WeightPriceService $weightPriceService)
    {
        $this->weightPriceService = $weightPriceService;
    }

    public function index()
    {
        return view('admin.weight_price.index');
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

    public function store(StoreWeightPriceRequest $request)
    {
        WeightPrice::create($request->all());
        return self::response('success', 'Successfully Setting Created!');
    }

    public function show(WeightPrice $weightPrice)
    {
        //
    }

    public function edit(WeightPrice $weightPrice)
    {
        $regions = Region::all();
        $weightOptions = weightoption::all();
        return view('admin.weight_price.edit', compact('regions', 'weightOptions', 'weightPrice'));
    }

    public function update(UpdateWeightPriceRequest $request, $id)
    {
        $weightPrice = WeightPrice::find($id);
        $weightPrice->update($request->all());
        return self::response('success', 'Successfully Setting Created!');
    }

    public function destroy(WeightPrice $weightPrice)
    {
        $weightPrice->delete();
        return self::response('success', 'Successfully WeightPrice Deleted!!');
    }
}
