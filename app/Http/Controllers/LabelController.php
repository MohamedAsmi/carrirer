<?php

namespace App\Http\Controllers;

use App\Http\Helper\Service\LabelService;
use App\Models\Label;
use App\Models\Region;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\User;
use App\Models\UserWeightPrice;
use App\Models\WeightOption;
use App\Models\WeightPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $html = '<option value="">Choose One</option>';
        // Assign options based on the selected value
        if ($selectedValue) {
            $UserWeightPrices = WeightOption::where('region_id',$selectedValue)->get();
            foreach($UserWeightPrices as $UserWeightPrice){
                $html .= '<option value='.$UserWeightPrice->id.'>'.$UserWeightPrice->name.'</option>';
            }
        }
        return response()->json($html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLabelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =User::where('id',Auth::user()->id)->select('credit_value')->first();
        $user_weight_prices = UserWeightPrice::where('user_id',Auth::user()->id)->where('weight_option_id',$request->service_id)->first();
        $weight_option = WeightOption::where('id',$request->service_id)->first();
        if($user_weight_prices){
            if( $user_weight_prices->credit < $user->credit_value){
                $amount = $user->credit_value - $user_weight_prices->credit;
                $updateuser = User::where('id', Auth::user()->id)
                ->update(['credit_value' => $amount]);

                $validatedData = $request->all();
                Label::create($validatedData);
                return self::response('success', 'Successfully Region Created!');
            }else{
                return self::response('error', 'Insufficient Balance!');
            }
        }else{
            if($weight_option){
    
                if($weight_option->value < $user->credit_value){
                    $amount = $user->credit_value - $weight_option->value;
                    $updateuser = User::where('id', Auth::user()->id)
                    ->update(['credit_value' => $amount]);

                    $validatedData = $request->all();
                    Label::create($validatedData);
                    return self::response('success', 'Successfully Region Created!');
                }else{
                    return self::response('error', 'Insufficient Balance!');
                }
            }
        }

        
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
