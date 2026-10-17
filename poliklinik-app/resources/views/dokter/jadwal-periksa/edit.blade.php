
<x-layouts.app title="Edit Jadwal Periksa">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Edit Jadwal Periksa
        </h2>

        <a href="{{ route('jadwal-periksa.index') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5
                   bg-slate-200 hover:bg-slate-300
                   text-slate-700 text-sm font-semibold
                   rounded-xl transition">
            <i class="fas fa-arrow-left text-xs"></i>
            Kembali
        </a>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-6">

            <form action="{{ route('jadwal-periksa.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Hari --}}
                <div class="mb-5">
                    <label for="hari" class="block mb-2 text-sm font-semibold text-slate-700">
                        Hari <span class="text-red-500">*</span>
                    </label>

                    <select name="hari" id="hari"
                        class="select select-bordered w-full rounded-xl @error('hari') select-error @enderror"
                        required>
                        <option value="">-- Pilih Hari --</option>

                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                            <option value="{{ $hari }}"
                                @selected(old('hari', $jadwal->hari) === $hari)>
                                {{ $hari }}
                            </option>
                        @endforeach
                    </select>

                    @error('hari')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jam Mulai --}}
                <div class="mb-5">
                    <label for="jam_mulai" class="block mb-2 text-sm font-semibold text-slate-700">
                        Jam Mulai <span class="text-red-500">*</span>
                    </label>

                    <input type="time"
                        name="jam_mulai"
                        id="jam_mulai"
                        value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}"
                        class="input input-bordered w-full rounded-xl @error('jam_mulai') input-error @enderror"
                        required>

                    @error('jam_mulai')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jam Selesai --}}
                <div class="mb-5">
                    <label for="jam_selesai" class="block mb-2 text-sm font-semibold text-slate-700">
                        Jam Selesai <span class="text-red-500">*</span>
                    </label>

                    <input type="time"
                        name="jam_selesai"
                        id="jam_selesai"
                        value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}"
                        class="input input-bordered w-full rounded-xl @error('jam_selesai') input-error @enderror"
                        required>

                    @error('jam_selesai')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-6">
                    <label for="status" class="block mb-2 text-sm font-semibold text-slate-700">
                        Status <span class="text-red-500">*</span>
                    </label>

                    <select name="status" id="status"
                        class="select select-bordered w-full rounded-xl @error('status') select-error @enderror"
                        required>
                        <option value="aktif"
                            @selected(old('status', $jadwal->status) === 'aktif')>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            @selected(old('status', $jadwal->status) === 'nonaktif')>
                            Nonaktif
                        </option>
                    </select>

                    @error('status')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">

                    <a href="{{ route('jadwal-periksa.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5
                               bg-slate-200 hover:bg-slate-300
                               text-slate-700 text-sm font-semibold
                               rounded-xl transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5
                               bg-primary hover:bg-primary/90
                               text-white text-sm font-semibold
                               rounded-xl transition">
                        <i class="fas fa-save text-xs"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>
    </div>

</x-layouts.app>
