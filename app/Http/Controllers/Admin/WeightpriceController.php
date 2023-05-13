<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Helper\Service\WeightpriceService;
use App\Models\weightprice;
use App\Models\weightoption;
use App\Http\Requests\Admin\weightprice\StoreweightpriceRequest;
use App\Http\Requests\Admin\weightprice\UpdateweightpriceRequest;
use App\Models\Region;

class WeightpriceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $WeightpriceService;

    public function __construct(WeightpriceService $WeightpriceService)
    {
        $this->WeightpriceService = $WeightpriceService;
    }

    public function index()
    {
        return view('admin.weightprice.index');
    }

    public function list()
    {
        return $this->WeightpriceService->WeightoptionListDatatable();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions =Region::all();
        $weightoptions=weightoption::all();
        return view('admin.weightprice.create',compact('regions','weightoptions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreweightpriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreweightpriceRequest $request)
    {

        weightprice::create($request->all());
        return self::response('success', 'Successfully Setting Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\weightprice  $weightprice
     * @return \Illuminate\Http\Response
     */
    public function show(weightprice $weightprice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\weightprice  $weightprice
     * @return \Illuminate\Http\Response
     */
    public function edit(weightprice $weightprice,$id)
    {
        $weightprice=weightprice::find($id);
        $regions =Region::all();
        $weightoptions=weightoption::all();
        return view('admin.weightprice.edit',compact('regions','weightoptions','weightprice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateweightpriceRequest  $request
     * @param  \App\Models\weightprice  $weightprice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateweightpriceRequest $request, $id)
    {
        $weightprice=weightprice::find($id);
        $weightprice->update($request->all());
        return self::response('success', 'Successfully Setting Created!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\weightprice  $weightprice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $weightprice = weightprice::find($id);
        $weightprice->delete();
        return self::response('success', 'Successfully WeightPrice Deleted!!');
    }
}
