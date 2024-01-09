<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $users = User::all();
        return view('auth.register', compact('users'));
    }

    public function AdminRegister()
    {
        return view('auth.adminRegistration');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'cnic' => ['required', 'string', 'max:15', 'unique:' . User::class],
            'phonenumber' => ['required', 'string', 'min:11', 'max:11', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'secret_code' => ['nullable']
        ]);

        $providedSecretCode = $request->input('secret_code');
        $correctSecretCode = config('app.admin_secret_code');
        $verifiedUser = false;
        if ($providedSecretCode === $correctSecretCode) {
            $role = 'admin';
            $verifiedUser = true;
        } else {
            $role = 'user';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cnic' => $request->cnic,
            'phonenumber' => $request->phonenumber,
            'password' => Hash::make($request->password),
            'role' => $role,
            'verifiedUser' => $verifiedUser,
        ]);

        // Assign the selected role to the user
        if ($providedSecretCode === $correctSecretCode) {
            $user->assignRole('admin');
            $verifiedUser = true;
        } else {
            $user->assignRole('user');
        }

        return redirect()->route('login');
    }
}
