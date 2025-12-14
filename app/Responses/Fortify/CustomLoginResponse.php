<?php

namespace App\Responses\Fortify;

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
        $user = auth()->user();

        if ($user->role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        } else {
            return redirect()->route('warga.dashboard');
        }
    }
}
