<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserWarga;
use App\Models\UserPetugas;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class LoginRegisterController extends Controller
{
    /**
     * Show warga login form
     */
    public function showWargaForm()
    {
        return view('livewire.auth.login');
    }

    /**
     * Handle warga login POST
     */
    public function wargaLogin(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','string'],
            'password' => ['required','string'],
        ]);

        $credentials = ['email' => $data['email'], 'password' => $data['password']];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('warga.dashboard');
        }

        return back()->withErrors(['email' => 'Credentials not match our records.'])->withInput($request->only('email'));
    }

    /**
     * Handle warga registration (if used)
     */
    public function wargaRegister(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        return redirect()->intended('/');
    }

    /**
     * Show petugas form
     */
    public function showPetugasForm()
    {
        return view('livewire.auth.petugas.login');
    }

    /**
     * Show petugas register form
     */
    public function showPetugasRegisterForm()
    {
        return view('livewire.auth.petugas.register');
    }

    /**
     * Handle petugas login
     */
    public function petugasLogin(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','string','email'],
            'password' => ['required','string'],
        ]);

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();
            return redirect()->route('petugas.dashboard');
        }

        return back()->withErrors(['email' => 'Credentials not match our records.']);
    }

    /**
     * Handle petugas registration
     */
    public function petugasRegister(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'petugas',
        ]);

        Auth::login($user);
        return redirect()->route('petugas.dashboard');
    }

    /**
     * Show petugas forgot password form
     */
    public function showPetugasForgotPasswordForm()
    {
        return view('livewire.auth.petugas.forgot-password');
    }

    /**
     * Handle petugas forgot password
     */
    public function showPetugasResetPasswordForm(Request $request, $token = null)
    {
        return view('livewire.auth.petugas.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function petugasResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('userspetugas')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('petugas.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
