<?php

namespace App\Http\Controllers;

use App\Http\Service\LabelService;
use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function handlePayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment', $request),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('credit.add')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('credit.add')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel()
    {
        return redirect()
            ->route('create.payment')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        // dd($request);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $user =User::where('id',Auth::user()->id)->select('credit_value')->first();
            $amount = $user->credit_value + $request->query('amount');
            LabelService::savePaypalCreditAmount($request->query('amount'),$amount,Credit::IS_PAYPAL);

            $updateuser = User::where('id', Auth::user()->id)
                ->update(['credit_value' => $amount]);
            return redirect()
                ->route('credit')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('credit')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}