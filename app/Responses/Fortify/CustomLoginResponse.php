<?php

namespace App\Responses\Fortify;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;

class CustomLoginResponse implements LoginResponse
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Asumsi ada kolom 'role' di tabel users dengan nilai 'warga' atau 'petugas'
        $user = Auth::user();

        $role = $user->role ?? 'warga'; // Default to 'warga' if role not set

        return redirect()->route('dashboard');
    }
}
