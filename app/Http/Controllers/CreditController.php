<?php

namespace App\Http\Controllers;

use App\Http\Service\CreditService;
use App\Models\Credit;
use App\Http\Requests\StoreCreditRequest;
use App\Http\Requests\UpdateCreditRequest;


class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $creditservice;
 

    public function __construct(CreditService $creditservice)
    {
        $this->middleware('auth');
        $this->creditservice = $creditservice;
    }
    public function index()
    {
        return view('user.credit.index');
    }

    public function list()
    {
        $creditservice = $this->creditservice->LabelDatatable();
        return $creditservice;
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
     * @param  \App\Http\Requests\StoreCreditRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(Credit $credit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditRequest  $request
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditRequest $request, Credit $credit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        //
    }
}
