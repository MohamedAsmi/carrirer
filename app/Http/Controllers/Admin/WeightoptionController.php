<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Helper\Service\WeightOptionService;
use App\Http\Requests\Admin\WeightOption\StoreWeightOptionRequest;
use App\Http\Requests\Admin\WeightOption\UpdateWeightOptionRequest;
use App\Models\WeightOption;



class WeightOptionController extends BaseController
{
    protected $weightOptionService;

    public function __construct(WeightOptionService $weightOptionService)
    {
        $this->weightOptionService = $weightOptionService;
    }

    public function list()
    {
        return $this->weightOptionService->WeightOptionListDatatable();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.weight_option.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weight_option.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWeightOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeightOptionRequest $request)
    {
        $validatedData = $request->validated();
        weightoption::create($validatedData);
        return self::response('success', 'Successfully Setting Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WeightOption  $weightOption
     * @return \Illuminate\Http\Response
     */
    public function show(WeightOption $weightOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WeightOption  $weightOption
     * @return \Illuminate\Http\Response
     */
    public function edit(WeightOption $weightOption)
    {
        return view('admin.weight_option.edit', compact('weightOption'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWeightOptionRequest  $request
     * @param  \App\Models\WeightOption  $weightOption
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWeightOptionRequest $request, $id)
    {
        $weightOption = weightoption::find($id);
        $weightOption->update($request->all());
        return self::response('success', 'Successfully WeightOption Updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeightOption  $weightOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeightOption $weightOption)
    {
        $weightOption->delete();
        return self::response('success', 'Successfully WeightOption Deleted!!');
    }
}
