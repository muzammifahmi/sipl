<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-white leading-tight">
            {{ __('Edit Alat: ') . $barang->nama_barang }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-8 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('barang.update', $barang->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="kode_barang" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Kode Barang <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required
                                           class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('kode_barang') border-red-500 @enderror">
                                </div>
                                <p class="mt-1 text-xs text-slate-500">Pastikan kode tetap unik.</p>
                                @error('kode_barang')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nama_barang" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Nama Alat <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('nama_barang') border-red-500 @enderror">
                                @error('nama_barang')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div>
                                <label for="kategori" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select id="kategori" name="kategori" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="Elektronik" {{ old('kategori', $barang->kategori) == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                    <option value="Pecah Belah" {{ old('kategori', $barang->kategori) == 'Pecah Belah' ? 'selected' : '' }}>Gelas / Pecah Belah</option>
                                    <option value="Bahan Kimia" {{ old('kategori', $barang->kategori) == 'Bahan Kimia' ? 'selected' : '' }}>Bahan Kimia</option>
                                    <option value="Mekanik" {{ old('kategori', $barang->kategori) == 'Mekanik' ? 'selected' : '' }}>Perkakas Mekanik</option>
                                    <option value="Lainnya" {{ old('kategori', $barang->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="stok_total" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Update Stok Total <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stok_total" id="stok_total" min="0" value="{{ old('stok_total', $barang->stok_total) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('stok_total') border-red-500 @enderror">
                                <p class="mt-2 text-xs text-slate-500 bg-slate-100 dark:bg-slate-700 p-2 rounded">
                                    Info: Mengubah stok total akan otomatis menyesuaikan stok tersedia. <br>
                                    Stok Tersedia saat ini: <strong>{{ $barang->stok_tersedia }}</strong>
                                </p>
                                @error('stok_total')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="lokasi_rak" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Lokasi Penyimpanan
                                </label>
                                <input type="text" name="lokasi_rak" id="lokasi_rak" value="{{ old('lokasi_rak', $barang->lokasi_rak) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                            <a href="{{ route('barang.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Perbarui Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
