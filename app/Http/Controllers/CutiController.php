<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dacu;

class CutiController extends Controller
{
    public function create()
    {
        return view('dashboard');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:20|unique:dacus',
        'jabatan' => 'required|string|max:255',
        'total_cuti' => 'required|integer',
        'sisa_cuti' => 'required|string',
        'status' => 'required|string|in:AKTIF,NONAKTIF',
    ]);

    try {
        $dacu = Dacu::create($validated);
        return redirect()->route('cuti')->with('success', 'Data cuti pegawai berhasil ditambahkan.');
    } catch (\Exception $e) {
        // Log the exception message
        return redirect()->route('cuti.index')->with('error', 'Gagal menyimpan data cuti pegawai.');
    }
}


    public function index()
    {
        $dacus = Dacu::all(); // Mengambil semua data dari tabel `dacus`
        return view('cuti', compact('dacus')); // Mengarahkan ke view yang menampilkan data cuti
    }

    public function edit($id)
    {
        $dacu = Dacu::findOrFail($id);
        return view('cuti.edit', compact('dacu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'jabatan' => 'required|string|max:100',
            'total_cuti' => 'required|numeric',
            'sisa_cuti' => 'required|numeric',
            'status' => 'required|in:AKTIF,NONAKTIF',
        ]);

        $dacu = Dacu::findOrFail($id);
        $dacu->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'total_cuti' =>$request->total_cuti,
            'sisa_cuti' =>$request->sisa_cuti,
            'status' => $request->status,
        ]);

        return redirect()->route('cuti.index')->with('success', 'Data cuti berhasil diperbarui.');
    }
}