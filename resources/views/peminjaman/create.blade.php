<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-white leading-tight">
            {{ __('Akuisisi Data Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-4 mb-6 rounded-r shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700 dark:text-blue-200">
                            <strong>Mode Input Raw Data:</strong> Data ini akan mengisi tabel <em>Mahasiswas</em>
                            (Master) dan <em>Peminjamans</em> (Transaksi). Fitur Preprocessing akan membersihkan kolom
                            "Jurusan" dan "Kondisi Alat" nanti.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 border-b border-gray-200 dark:border-gray-700">

                    <form method="POST" action="{{ route('peminjaman.store') }}" class="space-y-8">
                        @csrf

                        <div>
                            <h3
                                class="text-lg font-medium leading-6 text-slate-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-2 mb-4">
                                1. Data Mahasiswa (Tabel Master User)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nim"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">NIM</label>
                                    <input type="text" name="nim" id="nim" placeholder="Contoh: 12345678"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="nama"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="jurusan_raw"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                        Jurusan / Prodi <span class="text-xs text-red-500">(Input Manual - Raw
                                            Data)</span>
                                    </label>
                                    <input type="text" name="jurusan_raw" id="jurusan_raw"
                                        placeholder="Misal: T. Informatika, TI, atau Teknik Informatika" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="angkatan"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Angkatan</label>
                                    <input type="number" name="angkatan" id="angkatan" placeholder="2023" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email
                                        Kampus</label>
                                    <input type="email" name="email" id="email" placeholder="nama@kampus.ac.id"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-lg font-medium leading-6 text-slate-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-2 mb-4">
                                2. Data Alat & Kondisi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="barang_id"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Pilih Alat
                                        Lab</label>
                                    <select id="barang_id" name="barang_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">

                                        <option value="">-- Pilih Barang --</option>

                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}"
                                                {{ $barang->stok_tersedia == 0 ? 'disabled' : '' }}
                                                class="{{ $barang->stok_tersedia == 0 ? 'text-gray-400 bg-gray-100' : '' }}">

                                                {{ $barang->nama_barang }}
                                                (Stok: {{ $barang->stok_tersedia }})
                                                {{ $barang->stok_tersedia == 0 ? '- HABIS' : '' }}

                                            </option>
                                        @endforeach

                                    </select>

                                    <p class="mt-1 text-xs text-slate-500">
                                        *Barang dengan stok 0 tidak dapat dipilih.
                                    </p>
                                </div>

                                <div>
                                    <label for="kondisi_pinjam_raw"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                        Kondisi Alat Awal <span class="text-xs text-red-500">(Deskriptif - Raw)</span>
                                    </label>
                                    <input type="text" name="kondisi_pinjam_raw" id="kondisi_pinjam_raw"
                                        placeholder="Misal: Lecet dikit, normal, kotor"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>


                        <div>
                            <h3
                                class="text-lg font-medium leading-6 text-slate-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-2 mb-4">
                                3. Detail Transaksi Peminjaman
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="tgl_pinjam"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tanggal
                                        Pinjam</label>
                                    <input type="date" name="tgl_pinjam" id="tgl_pinjam" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="tgl_kembali_rencana"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Rencana
                                        Kembali</label>
                                    <input type="date" name="tgl_kembali_rencana" id="tgl_kembali_rencana" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="keperluan"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Keperluan
                                        Peminjaman</label>
                                    <textarea id="keperluan" name="keperluan" rows="3" placeholder="Contoh: Praktikum Fisika Dasar Modul 3"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                            <button type="button" onclick="window.location='{{ route('dashboard') }}'"
                                class="rounded-md border border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 py-2 px-4 text-sm font-medium text-slate-700 dark:text-white shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Batal
                            </button>
                            <button type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-transform transform active:scale-95">
                                Simpan Data Transaksi
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
