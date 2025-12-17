<?php

namespace App\Responses\Fortify;

use Laravel\Fortify\Contracts\RegisterResponse;

class CustomRegisterResponse implements RegisterResponse
{
    
    public function toResponse($request)
    {
        return redirect()->route('login')->with('success', 'Berhasil mendaftarkan akun, masuk sekarang!');
    }
}