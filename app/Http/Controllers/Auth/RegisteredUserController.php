<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:8', Password::min(8)
                    ->mixedCase()    // Must contain both uppercase and lowercase letters
                    ->letters()      // Must contain at least one letter
                    ->numbers()      // Must contain at least one number
                    ->symbols()      // Must contain at least one special character
                ],
            'phone' => 
                [
                    'required', 
                    'regex:/^(09|\+959)(9\d{7}|(42|25|67|69|68|96|40|45|77|75|94|66|74|78|97|44|26|76|79|98)\d{7})$/'
                ],
            'address' => 'required',
        ]);

        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);
        

        event(new Registered($user)); 

        return redirect()->route('login')->with('success', 'Your are registered successsfully. Please Login!');

    }
}