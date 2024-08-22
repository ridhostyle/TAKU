<?php

namespace App\Http\Controllers;

use App\Models\Coba;
use App\Models\permohonan;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function showForm()
    {
        return view('form_permohonan');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|string',
            'jabatan' => 'required|string',
            'mulai_cuti' => 'required|date',
            'selesai_cuti' => 'required|date',
            'jenis_cuti' => 'required|string',
            'alasan_cuti' => 'required|string',
            'status' => 'nullable|string'
        ]);
        
        // Menetapkan nilai default jika status tidak diberikan
        $validatedData['status'] = $validatedData['status'] ?? 'menunggu';        
    
        $permohonan = permohonan::create($validatedData);
    
        return response()->json(['id' => $permohonan->id]);
    }

    public function showStatus()
    {
        return view('cekstatus');
    }
    public function checkStatus(Request $request)
    {
        // Validasi ID permohonan
        $request->validate([
            'id' => 'required|integer',
        ]);
    
        // Cari permohonan berdasarkan ID
        $permohonan = permohonan::find($request->id);
    
        // Jika permohonan ditemukan, kembalikan data sebagai JSON
        if ($permohonan) {
            return response()->json($permohonan);
        }
    
        // Jika permohonan tidak ditemukan, kembalikan respons error
        return response()->json(['error' => 'Permohonan tidak ditemukan'], 404);
    }
    public function index()
    {
        $permohonan = permohonan::all(); // Mengambil semua data dari tabel `permohonan`
        return view('login.verifikasi', compact('permohonan')); // Mengarahkan ke view yang menampilkan data cuti
    }

    public function terima($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $permohonan->status = 'diterima';
        $permohonan->save();

        return redirect()->back()->with('success', 'Permohonan telah diterima.');
    }

    // Method untuk update status menjadi ditolak
    public function tolak($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $permohonan->status = 'ditolak';
        $permohonan->save();

        return redirect()->back()->with('success', 'Permohonan telah ditolak.');
    }
}
