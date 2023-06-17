<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;

class LoginController extends Controller
{
    use RedirectsUsers;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Check if the user's email is verified
        if (!$this->hasVerifiedEmail($request)) {
            return $this->sendFailedEmailVerificationResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Determine if the user has verified their email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasVerifiedEmail(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        if (Auth::validate($credentials)) {
            $user = Auth::getLastAttempted();

            if ($user && !$user->hasVerifiedEmail()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Send the response when the email is not verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    protected function sendFailedEmailVerificationResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed_email_verification')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * Resend the email verification link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendEmailVerification(Request $request)
    {
        $user = $request->user();

        if ($user && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return $this->sendEmailVerificationResponse($request);
        }

        return redirect()->route('login')->with('resent', true);
    }

    /**
     * Send the email verification response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendEmailVerificationResponse(Request $request)
    {
        return redirect($this->redirectPath())
            ->with('status', 'verification-link-sent');
    }
}
