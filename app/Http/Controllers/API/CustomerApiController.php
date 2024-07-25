<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerApiController extends Controller
{
    public function getProfile() {
        $id = Auth::user()->id;

        $data = Customer::where('id', $id)->with('Product')->get();

        return success($data, "Profile");
    }

    public function editProfile(Request $request) {
        $attributes = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
            'profile' => 'file|mimes:jpg,jpeg,png,gif',
            'address' => 'required|string',
            'phone' => 'required'
        ]);

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');

            $imgName = 'profiles/'.time(). '_' . uniqid() . '.' .$profile->getClientOriginalExtension();
            $profile->storeAs('public/profiles', $imgName,);

            $attributes['profile'] = $imgName;
        } else {
            unset($attributes['profile']);
        }
        $id = Auth::user()->id;

        $customer = Customer::where('id', $id)->first();

        if ($customer) {
            $customer->update($attributes);
            return success($customer, "Update profile success");
        }

        return failedMessage("Customer not found");
    }
}
