<?php

namespace App\Http\Controllers;

use App\Http\Service\CreditService;
use App\Http\Helper\Service\UserCreditService;
use App\Models\Credit;
use App\Http\Requests\StoreCreditRequest;
use App\Http\Requests\UpdateCreditRequest;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $creditservice;
 

    public function __construct(UserCreditService $creditservice)
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
        $creditservice = $this->creditservice->CreditDatatable();
        return $creditservice;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('user.credit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCreditRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditRequest $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00"
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
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
