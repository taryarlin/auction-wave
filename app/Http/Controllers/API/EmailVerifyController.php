<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function verify($customer_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return failedMessage('Invalid/Expired url provided');
        }

        $customer = Customer::findOrFail($customer_id);

        if (!$customer->hasVerifiedEmail()) {
            $customer->markEmailAsVerified();
        }

        return successMessage('Customer account is verified successfully');
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $customer = Customer::whereEmail($request->email)->firstOrFail();

        if ($customer->hasVerifiedEmail()) {
            return failedMessage('Email already verified');
        }

        $customer->sendEmailVerificationNotification();

        return successMessage('Email verification link sent on your email');
    }
}
