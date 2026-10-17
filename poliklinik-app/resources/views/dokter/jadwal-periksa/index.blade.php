
<x-layouts.app title="Jadwal Periksa">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Jadwal Periksa
        </h2>

        <a href="{{ route('jadwal-periksa.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5
                   bg-primary hover:bg-primary/90
                   text-white text-sm font-semibold
                   rounded-xl transition">
            <i class="fas fa-plus text-xs"></i>
            Tambah Jadwal
        </a>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table w-full">

                    {{-- Table Head --}}
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Hari</th>
                            <th class="px-6 py-4">Jam Mulai</th>
                            <th class="px-6 py-4">Jam Selesai</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="text-sm text-slate-700">
                        @forelse ($jadwal as $item)
                            <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $item->hari }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($item->status === 'aktif')
                                        <span class="inline-flex items-center gap-1 rounded-lg bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                                            <i class="fas fa-circle text-[7px]"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                                            <i class="fas fa-circle text-[7px]"></i>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('jadwal-periksa.edit', $item->id) }}"
                                            class="inline-flex items-center gap-1 px-4 py-2
                                                   bg-amber-500 hover:bg-amber-600
                                                   text-white text-xs font-semibold
                                                   rounded-lg transition">
                                            <i class="fas fa-pen text-xs"></i>
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('jadwal-periksa.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus jadwal periksa ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-4 py-2
                                                       bg-red-500 hover:bg-red-600
                                                       text-white text-xs font-semibold
                                                       rounded-lg transition">
                                                <i class="fas fa-trash text-xs"></i>
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-slate-400">
                                    <i class="fas fa-calendar-xmark text-3xl mb-3 block"></i>
                                    Belum ada jadwal periksa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</x-layouts.app>
