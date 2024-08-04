<?php

namespace App\Http\Controllers;

use Exception;
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
        $auth_user = Auth::guard('customer')->user();
        return view('profile.dashboard', compact('auth_user'));
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
        $auth_user = Auth::guard('customer')->user();
        return view('profile.personal.change_password', compact('auth_user'));
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
