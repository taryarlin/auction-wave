<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerRegisterRequest;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * login auth
     *
     * @param Request $request
     */
    public function login(CustomerLoginRequest $request)
    {
        if (!Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            return failedMessage('Credentials do not match');
        }

        $customer = Auth::guard('customer')->user();

        $token = $customer->createToken('UserToken')->plainTextToken;

        $data = [
            'customer' => $customer,
            'token' => $token,
        ];

        return success($data, 'Successfully Login');
    }

    /**
     * register auth
     *
     * @param Request $request
     */
    public function register(CustomerRegisterRequest $request)
    {
        $input = $request->validated();
        $input['password'] = Hash::make($request->password);

        if($request->profile) {
            $input['profile'] = $request->file('profile')->store('public/customer-images');
        }

        $customer = Customer::create($input);

        event(new Registered($customer));

        return success($customer, 'Successfully registered. Please check your mail to verify the account.');
    }

    /**
     * Auth Logout
     *
     */
    public function logout()
    {
        request()->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out Successfully.',
        ]);
    }
}
