<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->intended('/');
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
     * Show petugas form (optional)
     */
    public function showPetugasForm()
    {
        return view('livewire.auth.warga.login');
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
            return redirect()->intended('/admin');
        }

        return back()->withErrors(['email' => 'Credentials not match our records.']);
    }
}
