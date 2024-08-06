<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function dashboard()
    {
        return view('profile.dashboard');
    }

    public function personal()
    {
        $auth_user = Auth::guard('customer')->user();
        return view('profile.personal.index', compact('auth_user'));
    }

    public function personalEdit()
    {
        $auth_user = Auth::guard('customer')->user();
        return view('profile.personal.edit', compact('auth_user'));
    }

    public function personalUpdate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'date_of_birth' => 'required',
                'address' => 'required',
            ]);

            $auth_user = Auth::guard('customer')->user();

            Customer::where('id', $auth_user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
            ]);

            return redirect()->route('profile.personal.index')->with('success', 'Profile updated successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function personalChangePassword()
    {
        return view('profile.personal.change_password');
    }

    public function personalUpdatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|min:8|same:new_password',
            ]);

            $auth_user = Auth::guard('customer')->user();

            if (!Hash::check($request->current_password, $auth_user->password)) {
                throw new Exception('Current password does not match');
            }

            if ($request->new_password != $request->confirm_password) {
                throw new Exception('New password and Confirm password do not match');
            }

            Customer::where('id', $auth_user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('profile.personal.index')->with('success', 'Password updated successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function myProduct()
    {
        $auth_user = auth()->guard('customer')->user();
        $products = $auth_user->product()->latest()->paginate(4);

        return view('profile.my_product.index', compact('products'));
    }

    public function myProductCreate()
    {
        $categories = Category::get();
        return view('profile.my_product.create', compact('categories'));
    }

    public function myProductStore(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'starting_price' => 'required',
                'fixed_price' => 'required',
                'start_datetime' => 'required',
                'end_datetime' => 'required',
                'buyer_premium_percent' => 'required',
                'bid_increment' => 'required',
                'images' => 'required'
            ]);

            $auth_user = auth()->guard('customer')->user();

            Product::create([
                'name' => $request->name,
                'ownerable_type' => Customer::class,
                'ownerable_id' => $auth_user->id,
                'category_id' => $request->category_id,
                'customer_id' => $auth_user->id,
                'starting_price' => $request->starting_price,
                'fixed_price' => $request->fixed_price,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'buyer_premium_percent' => $request->buyer_premium_percent,
                'bid_increment' => $request->bid_increment,
                'images' => $request->images,
                'description' => $request->description,
                'delivery_option' => $request->delivery_option
            ]);

            return redirect()->route('profile.my-product.index')->with('success', 'Product created successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function myProductEdit(Product $product, Request $request)
    {
        $categories = Category::get();
        return view('profile.my_product.edit', compact('product', 'categories'));
    }

    public function myProductUpdate(Product $product, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'starting_price' => 'required',
                'fixed_price' => 'required',
                'start_datetime' => 'required',
                'end_datetime' => 'required',
                'buyer_premium_percent' => 'required',
                'bid_increment' => 'required',
                'images' => 'required'
            ]);

            $auth_user = auth()->guard('customer')->user();

            Product::create([
                'name' => $request->name,
                'ownerable_type' => Customer::class,
                'ownerable_id' => $auth_user->id,
                'category_id' => $request->category_id,
                'customer_id' => $auth_user->id,
                'starting_price' => $request->starting_price,
                'fixed_price' => $request->fixed_price,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'buyer_premium_percent' => $request->buyer_premium_percent,
                'bid_increment' => $request->bid_increment,
                'images' => $request->images,
                'description' => $request->description,
                'delivery_option' => $request->delivery_option
            ]);

            return redirect()->route('profile.my-product.index')->with('success', 'Product created successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
