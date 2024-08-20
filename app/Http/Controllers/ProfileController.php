<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard()
    {
        $auth_user = auth()->guard('customer')->user();

        $my_products = $auth_user->products()->paginate(10);
        $active_bids = $auth_user->active_bids()->paginate(10);
        $winning_bids = $auth_user->winning_bids()->paginate(10);

        return view('profile.dashboard', compact('my_products', 'active_bids', 'winning_bids'));
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

    public function personalProfileImageEdit()
    {
        $auth_user = Auth::guard('customer')->user();

        return view('profile.personal.profile_image_edit', compact('auth_user'));
    }

    public function personalProfileImageUpdate(Request $request)
    {
        try {
            $request->validate([
                'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $auth_user = Auth::guard('customer')->user();

            if ($request->hasFile('profile')) {
                if ($auth_user->profile) {
                    if (Storage::exists('public/' . $auth_user->profile)) {
                        Storage::delete('public/' . $auth_user->profile);
                    }
                }

                $file_name = 'customer-images/' . time() . '_' . uniqid() . '.' . str_replace(' ', '', $request->profile->getClientOriginalName());
                $request->profile->storeAs('public/', $file_name);
            }

            Customer::where('id', $auth_user->id)->update([
                'profile' => $file_name
            ]);

            return redirect()->route('profile.personal.index')->with('success', 'Profile Image updated successfully');

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
                'images' => 'required',
                'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048',
            ]);

            $auth_user = auth()->guard('customer')->user();

            $file_names_ary = [];

            if ($request->hasFile('images')) {
                foreach($request->file('images') as $file) {
                    $file_name = 'product-images/' . time() . '_' . uniqid() . '.' . str_replace(' ', '', $file->getClientOriginalName());
                    $file->storeAs('public/', $file_name);
                    $file_names_ary[] = $file_name;
                }
            }

            Product::create([
                'name' => $request->name,
                'ownerable_type' => Customer::class,
                'ownerable_id' => $auth_user->id,
                'category_id' => $request->category_id,
                'customer_id' => $auth_user->id,
                'starting_price' => $request->starting_price,
                'fixed_price' => $request->fixed_price,
                'start_datetime' => Carbon::parse($request->start_datetime)->format('Y-m-d H:i:s'),
                'end_datetime' => Carbon::parse($request->end_datetime)->format('Y-m-d H:i:s'),
                'buyer_premium_percent' => $request->buyer_premium_percent,
                'bid_increment' => $request->bid_increment,
                'images' => $file_names_ary,
                'description' => $request->description,
                'delivery_option' => $request->delivery_option
            ]);

            return redirect()->route('profile.my-product.index')->with('success', 'successfully Product created. Please wait for admin approve.');

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
                'images' => !$product->images ? 'required' : 'nullable',
                'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048',
            ]);

            $auth_user = auth()->guard('customer')->user();

            $file_names_ary = [];

            if ($request->hasFile('images')) {
                if ($product->images) {
                    foreach($product->images as $image) {
                        if (Storage::exists('public/' . $image)) {
                            Storage::delete('public/' . $image);
                        }
                    }
                }

                foreach($request->file('images') as $file) {
                    $file_name = 'product-images/' . time() . '_' . uniqid() . '.' . str_replace(' ', '', $file->getClientOriginalName());
                    $file->storeAs('public/', $file_name);
                    $file_names_ary[] = $file_name;
                }
            }

            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'starting_price' => $request->starting_price,
                'fixed_price' => $request->fixed_price,
                'start_datetime' => Carbon::parse($request->start_datetime)->format('Y-m-d H:i:s'),
                'end_datetime' => Carbon::parse($request->end_datetime)->format('Y-m-d H:i:s'),
                'buyer_premium_percent' => $request->buyer_premium_percent,
                'bid_increment' => $request->bid_increment,
                'images' => $file_names_ary ? $file_names_ary : $product->images,
                'description' => $request->description,
                'delivery_option' => $request->delivery_option
            ]);

            return redirect()->route('profile.my-product.index')->with('success', 'Product updated successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function myProductDelete(Product $product, Request $request)
    {
        try {
            if (!$request->ajax()) {
                Exception('Invalid Request!');
            }

            if ($product->images) {
                foreach($product->images as $image) {
                    if (Storage::exists('public/' . $image)) {
                        Storage::delete('public/' . $image);
                    }
                }
            }

            $product->delete();

            return response()->json([
                'result' => 1,
                'message' => 'Successfully delete.'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'result' => 0,
                'message' => 'Something wrong!',
                'data' => $e->getMessage()
            ]);
        }
    }

    public function myBid()
    {
        $products = Product::whereHas('auctions', function ($query) {
            return $query->where('customer_id', auth()->guard('customer')->user()->id);
        })->latest()->paginate(4);

        return view('profile.my_bid.index', compact('products'));
    }

    public function winningBid()
    {
        $products = Product::where('winner_id', auth()->guard('customer')->user()->id)->finished()->whereNotNull(['won_amount', 'won_datetime'])->latest()->paginate(4);

        return view('profile.winning_bid.index', compact('products'));
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
