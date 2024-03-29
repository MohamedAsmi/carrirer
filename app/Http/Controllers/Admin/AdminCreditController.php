<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Service\CreditService;


class AdminCreditController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $creditdatatable;
    

    public function list(CreditService $creditdatatable,Request $request)
    {
        $formData = $request->input('form_data');
        parse_str($formData, $formDataArray);

        $user_id = $formDataArray['user_id'];
        $min = $formDataArray['min'];
        $max = $formDataArray['max'];

        $CreditDatatable = $creditdatatable->CreditDatatable($user_id,$min,$max);
        return $CreditDatatable;
    }
    public function index()
    {
        $users = User::all();
        return view('admin.credit.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.credit.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findById($request->user_id);
        $credit = New Credit();
        $credit->credit_added = Carbon::now();
        $credit->credit_amount = $request->credit_amount;
        $credit->total = $user->credit_value + $request->credit_amount;
        $credit->source_id = $request->source;
        $credit->details = $request->details;
        $credit->addto = $request->user_id;
        $credit->addby = Auth::user()->id;
        $credit->save();

        User::where('id', $request->user_id)->update([
            'credit_value' => DB::raw("credit_value + $request->credit_amount"),
        ]);
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
}
