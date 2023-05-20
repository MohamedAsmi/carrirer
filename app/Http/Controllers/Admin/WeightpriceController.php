<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Helper\Service\WeightPriceService;
use App\Models\WeightPrice;
use App\Http\Requests\Admin\weightprice\StoreWeightPriceRequest;
use App\Http\Requests\Admin\weightprice\UpdateWeightPriceRequest;
use App\Models\Region;
use App\Models\WeightOption;

class WeightPriceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        $weightOptions = WeightOption::all();
        return view('admin.weight_price.create', compact('regions', 'weightOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWeightPriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeightPriceRequest $request)
    {
        WeightPrice::create($request->all());
        return self::response('success', 'Successfully Setting Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WeightPrice  $weightPrice
     * @return \Illuminate\Http\Response
     */
    public function show(WeightPrice $weightPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WeightPrice  $weightPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(WeightPrice $weightPrice)
    {
        $regions = Region::all();
        $weightOptions = weightoption::all();
        return view('admin.weight_price.edit', compact('regions', 'weightOptions', 'weightPrice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWeightPriceRequest  $request
     * @param  \App\Models\WeightPrice  $weightPrice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWeightPriceRequest $request, $id)
    {
        $weightPrice = WeightPrice::find($id);
        $weightPrice->update($request->all());
        return self::response('success', 'Successfully Setting Created!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeightPrice  $weightPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeightPrice $weightPrice)
    {
        $weightPrice->delete();
        return self::response('success', 'Successfully WeightPrice Deleted!!');
    }
}
