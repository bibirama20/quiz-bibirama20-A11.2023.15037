
<x-layouts.app title="Tambah Obat">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('obat.index') }}" class="flex items-center justify-center w-9 h-9
                  rounded-lg bg-slate-100 hover:bg-slate-200
                  text-slate-600 transition">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>

        <h2 class="text-2xl font-bold text-slate-800">
            Tambah Obat
        </h2>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-8">

            <form action="{{ route('obat.store') }}" method="POST">
                @csrf

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-6">

                    {{-- Nama Obat --}}
                    <div>
                        <label for="nama_obat" class="block text-sm font-semibold text-slate-700 mb-1">
                            Nama Obat <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                            id="nama_obat"
                            name="nama_obat"
                            value="{{ old('nama_obat') }}"
                            placeholder="Masukkan nama obat..."
                            maxlength="255"
                            class="w-full border-2 rounded-lg p-2
                                   focus:border-primary focus:outline-none
                                   @error('nama_obat') border-red-500 @enderror"
                            required>

                        @error('nama_obat')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kemasan --}}
                    <div>
                        <label for="kemasan" class="block text-sm font-semibold text-slate-700 mb-1">
                            Kemasan
                        </label>

                        <input type="text"
                            id="kemasan"
                            name="kemasan"
                            value="{{ old('kemasan') }}"
                            placeholder="Contoh: Strip, Tablet, Botol..."
                            maxlength="35"
                            class="w-full border-2 rounded-lg p-2
                                   focus:border-primary focus:outline-none
                                   @error('kemasan') border-red-500 @enderror">

                        @error('kemasan')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label for="harga" class="block text-sm font-semibold text-slate-700 mb-1">
                            Harga Obat (Rp) <span class="text-red-500">*</span>
                        </label>

                        <input type="number"
                            id="harga"
                            name="harga"
                            value="{{ old('harga') }}"
                            placeholder="Masukkan harga obat..."
                            min="0"
                            step="1"
                            class="w-full border-2 rounded-lg p-2
                                   focus:border-primary focus:outline-none
                                   @error('harga') border-red-500 @enderror"
                            required>

                        @error('harga')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-primary
                               hover:bg-primary/90 text-white
                               font-semibold text-sm transition">
                        <i class="fas fa-save mr-1"></i>
                        Simpan
                    </button>

                    <a href="{{ route('obat.index') }}"
                        class="px-6 py-2.5 rounded-xl bg-slate-100
                               hover:bg-slate-200 text-slate-600
                               font-semibold text-sm transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-layouts.app>
