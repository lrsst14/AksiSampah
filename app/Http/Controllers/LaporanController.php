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
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'jenis_sampah' => 'required|string|max:255',
            'gram' => 'required|integer|min:1',
            'jadwal_id' => 'required|exists:jadwals,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan-foto', 'public');
        }

        $poin = floor($request->gram / 100) * 10;

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->increment('poin', $poin);

        Laporan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul ?: 'Laporan Sampah',
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'jenis_sampah' => $request->jenis_sampah,
            'gram' => $request->gram,
            'jadwal_id' => $request->jadwal_id,
            'foto' => $fotoPath,
            'status' => 'pending',
        ]);

        return redirect()->route('warga.laporan')->with('success', 'Laporan berhasil terkirim, tunggu verifikasi petugas.');
    }

    public function index()
    {
        $pendingLaporans = Laporan::with('user', 'jadwal')->where('status', 'pending')->orderBy('created_at', 'desc')->get();
        $verifiedLaporans = Laporan::with('user', 'jadwal')->where('status', 'verified')->orderBy('created_at', 'desc')->get();
        return view('laporanpetugas', compact('pendingLaporans', 'verifiedLaporans'));
    }

    public function verify(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update(['status' => 'verified']);

        return redirect()->back()->with('success', 'Laporan verified.');
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:pending,verified',
        ]);

        $laporan->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
