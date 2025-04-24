<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
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

    public function login(Request $request)
    {
        // Validate request data
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        // Custom error handling
        $user = User::where('username', $request->username)->first();

        // Check if user exists
        if (!$user) {
            throw ValidationException::withMessages([
                'username' => ['Username salah.'],
            ]);
        }

        // Check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password salah.'],
            ]);
        }

        // If we reach here, it means both the username and password are incorrect
        throw ValidationException::withMessages([
            'username' => ['Username salah.'],
            'password' => ['Password salah.'],
        ]);
    }
}
