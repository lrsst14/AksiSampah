<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan-foto', 'public');
        }

        Laporan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'foto' => $fotoPath,
            'status' => 'pending',
        ]);

        return redirect()->route('warga.laporan')->with('success', 'Laporan berhasil dikirim dan menunggu verifikasi.');
    }

    public function index()
    {
        $laporans = Laporan::with('user')->orderBy('created_at', 'desc')->get();
        return view('laporanpetugas', compact('laporans'));
    }

    public function verify($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update(['status' => 'verified']);

        return redirect()->route('petugas.daftar')->with('success', 'Laporan berhasil diverifikasi.');
    }
}
