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

    public function index()
    {
        return view('admin.weight_option.index');
    }

    public function create()
    {
        return view('admin.weight_option.create');
    }

    public function store(StoreWeightOptionRequest $request)
    {
        $validatedData = $request->validated();
        weightoption::create($validatedData);
        return self::response('success', 'Successfully Setting Created!');
    }

    public function show(WeightOption $weightOption)
    {
        //
    }

    public function edit(WeightOption $weightOption)
    {
        return view('admin.weight_option.edit', compact('weightOption'));
    }

    public function update(UpdateWeightOptionRequest $request, $id)
    {
        $weightOption = weightoption::find($id);
        $weightOption->update($request->all());
        return self::response('success', 'Successfully WeightOption Updated !!!');
    }

    public function destroy(WeightOption $weightOption)
    {
        try {
            $weightOption->delete();
            return $this->_response('success', 'Weight Option deleted successfully', [], 200);
        } catch (\Exception $e) {
            return $this->_response('error', $e->getMessage(), [], 422);
        }
    }
}
