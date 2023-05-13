<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Helper\Service\WeightoptionService;
use App\Http\Requests\Admin\weightoption\StoreweightoptionRequest as WeightoptionStoreweightoptionRequest;
use App\Http\Requests\Admin\Weightoption\StoreweightoptionRequest;
use App\Http\Requests\Admin\Weightoption\UpdateweightoptionRequest;
use App\Models\weightoption;



class WeightoptionController extends BaseController
{
    protected $WeightoptionService;

    public function __construct(WeightoptionService $WeightoptionService)
    {
        $this->WeightoptionService = $WeightoptionService;
    }

    public function list()
    {
        return $this->WeightoptionService->WeightoptionListDatatable();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.weightoption.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weightoption.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreweightoptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreweightoptionRequest $request)
    {
        $validatedData = $request->validated();
        weightoption::create($validatedData);
        return self::response('success', 'Successfully Setting Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\weightoption  $weightoption
     * @return \Illuminate\Http\Response
     */
    public function show(weightoption $weightoption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\weightoption  $weightoption
     * @return \Illuminate\Http\Response
     */
    public function edit(weightoption $weightoption,$id)
    {
        $weightoption=weightoption::find($id);
        return view('admin.weightoption.edit',compact('weightoption'));

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateweightoptionRequest  $request
     * @param  \App\Models\weightoption  $weightoption
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateweightoptionRequest $request, $id)
    {
        $weightoption=weightoption::find($id);
        $weightoption->update($request->all());
        return self::response('success', 'Successfully WeightOption Updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\weightoption  $weightoption
     * @return \Illuminate\Http\Response
     */
    public function destroy(weightoption $weightoption,$id)
    {
        $weightoption = weightoption::find($id);
        $weightoption->delete();
        
        return self::response('success', 'Successfully WeightOption Deleted!!');
    }
}
