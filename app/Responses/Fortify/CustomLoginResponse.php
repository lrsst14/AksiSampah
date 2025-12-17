<?php

namespace App\Responses\Fortify;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;

class CustomLoginResponse implements LoginResponse
{
    
    public function toResponse($request)
    {
        
        $user = Auth::user();

        $role = $user->role ?? 'warga'; 

        if ($role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        } else {
            return redirect()->route('warga.dashboard');
        }
    }
}
