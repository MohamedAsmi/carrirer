<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Service\LabelService;
use App\Http\Requests\Api\StoreLabelRequest;
use App\Models\Credit;
use App\Models\Label;
use App\Models\Region;
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
    public function index()
    {
        $label = Label::all();
        return $this->response($label , 'successfully Fetched Data.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabelRequest $request)
    {
        $user = $request->user(); 
        $userId = $user->id;
        $userCredit = $user->credit_value;
        
        $userWeightPrices = UserWeightPrice::where('user_id', $userId)
                                           ->where('weight_option_id', $request->service_id)
                                           ->first();
        
        $weightOption = WeightOption::where('name', $request->service_id)->first();
        $rigion = Region::where('name', $request->rigion)->first();
        $weightPrice = $weightOption ? WeightPrice::find($weightOption->id) : null;
    
        if (!$rigion) {
            return self::response('error', 'Rigion Not Found!');
        }

        if (!$weightOption) {
            return self::response('error', 'Service Not Found!');
        }
        
        if ($userWeightPrices) {
            $requiredCredit = $userWeightPrices->credit;
        } elseif ($weightPrice) {
            $requiredCredit = $weightPrice->credits;
        } else {
            return self::response('error', 'Invalid Weight Option or Price!');
        }
    
        if ($requiredCredit > $userCredit) {
            return self::response('error', 'Insufficient Balance!');
        }
        
        $remainingCredit = $userCredit - $requiredCredit;
        User::where('id', $userId)->update(['credit_value' => $remainingCredit]);
        
        LabelService::saveCreditAmount($requiredCredit, $remainingCredit, Credit::IS_LABEL);
        
        $validatedData = $request->all();
        $validatedData['rigion'] = $rigion->id;
        $validatedData['service_id'] = $weightOption->id;
        Label::create($validatedData);
        
        return self::response('success', 'Successfully Region Created!');
    }
    
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->response($success, 'User login successfully.');
        } 
        else{ 
            return $this->response('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}
