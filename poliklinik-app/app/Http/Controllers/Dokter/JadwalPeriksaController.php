<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JadwalPeriksaController extends Controller
{
    /**
     * Menampilkan jadwal milik dokter yang login.
     */
    public function index()
    {
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::id())
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('dokter.jadwal-periksa.index', compact('jadwal'));
    }

    /**
     * Menampilkan form tambah jadwal.
     */
    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    /**
     * Menyimpan jadwal baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => [
                'required',
                Rule::in([
                    'Senin', 'Selasa', 'Rabu', 'Kamis',
                    'Jumat', 'Sabtu', 'Minggu',
                ]),
            ],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => [
                'required',
                'date_format:H:i',
                'after:jam_mulai',
            ],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ], [
            'hari.required' => 'Hari wajib dipilih.',
            'hari.in' => 'Hari yang dipilih tidak valid.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Format jam mulai tidak valid.',
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' => 'Format jam selesai tidak valid.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'status.required' => 'Status jadwal wajib dipilih.',
            'status.in' => 'Status jadwal tidak valid.',
        ]);

        $validated['id_dokter'] = Auth::id();

        JadwalPeriksa::create($validated);

        return redirect()
            ->route('jadwal-periksa.index')
            ->with('message', 'Jadwal periksa berhasil ditambahkan.')
            ->with('type', 'success');
    }

    /**
     * Menampilkan form edit jadwal milik dokter yang login.
     */
    public function edit(JadwalPeriksa $jadwal_periksa)
    {
        abort_unless(
            $jadwal_periksa->id_dokter == Auth::id(),
            403
        );

        return view(
            'dokter.jadwal-periksa.edit',
            ['jadwal' => $jadwal_periksa]
        );
    }

    /**
     * Memperbarui jadwal.
     */
    public function update(Request $request, JadwalPeriksa $jadwal_periksa)
    {
        abort_unless(
            $jadwal_periksa->id_dokter == Auth::id(),
            403
        );

        $validated = $request->validate([
            'hari' => [
                'required',
                Rule::in([
                    'Senin', 'Selasa', 'Rabu', 'Kamis',
                    'Jumat', 'Sabtu', 'Minggu',
                ]),
            ],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => [
                'required',
                'date_format:H:i',
                'after:jam_mulai',
            ],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ], [
            'hari.required' => 'Hari wajib dipilih.',
            'hari.in' => 'Hari yang dipilih tidak valid.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Format jam mulai tidak valid.',
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' => 'Format jam selesai tidak valid.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'status.required' => 'Status jadwal wajib dipilih.',
            'status.in' => 'Status jadwal tidak valid.',
        ]);

        $jadwal_periksa->update($validated);

        return redirect()
            ->route('jadwal-periksa.index')
            ->with('message', 'Jadwal periksa berhasil diperbarui.')
            ->with('type', 'success');
    }

    /**
     * Menghapus jadwal milik dokter yang login.
     */
    public function destroy(JadwalPeriksa $jadwal_periksa)
    {
        abort_unless(
            $jadwal_periksa->id_dokter == Auth::id(),
            403
        );

        $jadwal_periksa->delete();

        return redirect()
            ->route('jadwal-periksa.index')
            ->with('message', 'Jadwal periksa berhasil dihapus.')
            ->with('type', 'success');
    }
}
