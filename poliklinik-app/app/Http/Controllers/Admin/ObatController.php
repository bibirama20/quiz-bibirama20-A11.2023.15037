<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ObatController extends Controller
{
    /**
     * Menampilkan daftar obat.
     */
    public function index()
    {
        $obat = Obat::orderBy('nama_obat')->get();

        return view('admin.obat.index', compact('obat'));
    }

    /**
     * Menampilkan form tambah obat.
     */
    public function create()
    {
        return view('admin.obat.create');
    }

    /**
     * Menyimpan obat baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'nullable|string|max:35',
            'harga'     => 'required|integer|min:0',
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'nama_obat.max'      => 'Nama obat maksimal 255 karakter.',
            'kemasan.max'        => 'Kemasan maksimal 35 karakter.',
            'harga.required'     => 'Harga obat wajib diisi.',
            'harga.integer'      => 'Harga harus berupa bilangan bulat.',
            'harga.min'          => 'Harga tidak boleh kurang dari 0.',
        ]);

        Obat::create($validated);

        return redirect()
            ->route('obat.index')
            ->with('message', 'Data Obat berhasil ditambahkan')
            ->with('type', 'success');
    }

    /**
     * Menampilkan form edit obat.
     */
    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    /**
     * Memperbarui data obat.
     */
    public function update(Request $request, Obat $obat)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'nullable|string|max:35',
            'harga'     => 'required|integer|min:0',
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'nama_obat.max'      => 'Nama obat maksimal 255 karakter.',
            'kemasan.max'        => 'Kemasan maksimal 35 karakter.',
            'harga.required'     => 'Harga obat wajib diisi.',
            'harga.integer'      => 'Harga harus berupa bilangan bulat.',
            'harga.min'          => 'Harga tidak boleh kurang dari 0.',
        ]);

        $obat->update($validated);

        return redirect()
            ->route('obat.index')
            ->with('message', 'Data Obat berhasil diubah')
            ->with('type', 'success');
    }

    /**
     * Menghapus obat.
     */
    public function destroy(Obat $obat)
    {
        try {
            $obat->delete();

            return redirect()
                ->route('obat.index')
                ->with('message', 'Data Obat berhasil dihapus')
                ->with('type', 'success');

        } catch (QueryException $e) {
            return redirect()
                ->route('obat.index')
                ->with('message', 'Obat tidak dapat dihapus karena masih digunakan dalam data pemeriksaan.')
                ->with('type', 'error');
        }
    }
}
