<?php

namespace App\Http\Controllers;

use App\Http\Helper\Service\LabelService;
use App\Models\Label;
use App\Models\Region;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\UserWeightPrice;
use App\Models\WeightOption;
use Illuminate\Http\Request;


class LabelController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $labelservice;
 

    public function __construct(LabelService $labelservice)
    {
        $this->middleware('auth');
        $this->labelservice = $labelservice;
    }

    
    public function index()
    {
        return view('user.label.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions= Region::all();
        return view('user.label.create',compact('regions'));
    }

    public function getDropdownValues(Request $request)
    {
        $selectedValue = $request->input('selectedValue');

        // Assign options based on the selected value
        $options = [];
        if ($selectedValue) {
            $options = UserWeightPrice::where('region_id',$selectedValue);
        }

        return response()->json($options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLabelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabelRequest $request)
    {
        $validatedData = $request->all();
        // dd($validatedData);

        Label::create($validatedData);
        return self::response('success', 'Successfully Region Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        //
    }

    public function list()
    {
        $UserListDatatable = $this->labelservice->LabelDatatable();
        return $UserListDatatable;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regions= Region::all();
        $labels= Label::findById($id);
        return view('user.label.edit', compact('regions','labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLabelRequest  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabelRequest $request, Label $label)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        //
    }
    public function delete($id)
    {
        $user = Label::findById($id);
        $user->delete();
        return self::response('success', 'Deleted!');
    }
}
