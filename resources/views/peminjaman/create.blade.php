<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 dark:text-white leading-tight">
                {{ __('Akuisisi Data Peminjaman') }}
            </h2>
            <div class="text-sm text-blue-600 dark:text-blue-400">
                <svg class="inline w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Mode Input Raw Data
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Informasi Mode Input -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/10 dark:to-indigo-900/10 border-l-4 border-blue-500 rounded-lg shadow-sm p-5 mb-8">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-0.5">
                        <svg class="h-6 w-6 text-blue-500 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-300 mb-1">Mode Input Raw Data</h3>
                        <div class="text-sm text-blue-700 dark:text-blue-200 space-y-1">
                            <p class="flex items-center">
                                <span class="inline-block w-2 h-2 bg-blue-400 rounded-full mr-2"></span>
                                Data akan mengisi tabel <strong class="mx-1">Mahasiswas</strong> (Master) dan <strong class="mx-1">Peminjamans</strong> (Transaksi)
                            </p>
                            <p class="flex items-center">
                                <span class="inline-block w-2 h-2 bg-blue-400 rounded-full mr-2"></span>
                                Kolom "Jurusan" dan "Kondisi Alat" akan dibersihkan melalui fitur Preprocessing nanti
                            </p>
                            <p class="flex items-center mt-2 text-blue-600 dark:text-blue-300">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                                </svg>
                                Gunakan tombol <strong>"Cari NIM"</strong> untuk mengisi data otomatis jika mahasiswa sudah terdaftar
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <!-- Progress Steps -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <div class="px-8 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shadow-md">
                                        1
                                    </div>
                                    <span class="text-xs mt-1 font-medium text-blue-600 dark:text-blue-400">Data Mahasiswa</span>
                                </div>
                                <div class="h-1 w-16 bg-gray-300 dark:bg-gray-600"></div>
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shadow-md">
                                        2
                                    </div>
                                    <span class="text-xs mt-1 font-medium text-blue-600 dark:text-blue-400">Data Alat</span>
                                </div>
                                <div class="h-1 w-16 bg-gray-300 dark:bg-gray-600"></div>
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shadow-md">
                                        3
                                    </div>
                                    <span class="text-xs mt-1 font-medium text-blue-600 dark:text-blue-400">Transaksi</span>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Form Akuisisi Peminjaman
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form method="POST" action="{{ route('peminjaman.store') }}" class="space-y-10" id="peminjaman-form">
                        @csrf

                        <!-- Section 1: Data Mahasiswa -->
                        <div class="space-y-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 dark:text-white">
                                    Data Mahasiswa
                                </h3>
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                    Tabel Master User
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- NIM Field with Search -->
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <label for="nim" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                            NIM <span class="text-red-500">*</span>
                                        </label>
                                        <button type="button" id="search-nim"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 dark:bg-blue-900/50 dark:text-blue-300 dark:hover:bg-blue-800/50 transition-colors">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                            Cari NIM
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="nim" id="nim" placeholder="Contoh: 12345678" required
                                            class="pl-10 mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Gunakan tombol Cari NIM untuk mengisi data secara otomatis</p>
                                </div>

                                <!-- Nama Field -->
                                <div class="space-y-2">
                                    <label for="nama" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" required
                                            class="pl-10 mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                    </div>
                                </div>

                                <!-- Jurusan Field -->
                                <div class="md:col-span-2 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <label for="jurusan_raw" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                            Jurusan / Program Studi
                                        </label>
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            Input Manual - Raw Data
                                        </span>
                                    </div>
                                    <input type="text" name="jurusan_raw" id="jurusan_raw"
                                        placeholder="Misal: Teknik Informatika, T. Informatika, TI, atau Sistem Informasi"
                                        required
                                        class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Data ini akan dinormalisasi melalui fitur preprocessing</p>
                                </div>

                                <!-- Angkatan Field -->
                                <div class="space-y-2">
                                    <label for="angkatan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        Angkatan <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input type="number" name="angkatan" id="angkatan" placeholder="2023" required min="2000" max="2099"
                                            class="pl-10 mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        Email Kampus
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input type="email" name="email" id="email" placeholder="nama@kampus.ac.id"
                                            class="pl-10 mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Data Alat & Kondisi -->
                        <div class="space-y-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 dark:text-white">
                                    Data Alat & Kondisi
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Pilih Alat Lab -->
                                <div class="space-y-2">
                                    <label for="barang_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        Pilih Alat Lab <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </div>
                                        <select id="barang_id" name="barang_id" required
                                            class="pl-10 mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                            <option value="">-- Pilih Barang --</option>
                                            @foreach ($barangs as $barang)
                                                <option value="{{ $barang->id }}"
                                                    {{ $barang->stok_tersedia == 0 ? 'disabled' : '' }}
                                                    class="{{ $barang->stok_tersedia == 0 ? 'text-gray-400 bg-gray-100 dark:bg-gray-800' : '' }}">
                                                    {{ $barang->nama_barang }}
                                                    (Stok: {{ $barang->stok_tersedia }})
                                                    {{ $barang->stok_tersedia == 0 ? '- HABIS' : '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        *Barang dengan stok 0 tidak dapat dipilih
                                    </p>
                                </div>

                                <!-- Kondisi Alat Awal -->
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <label for="kondisi_pinjam_raw" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                            Kondisi Alat Awal
                                        </label>
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            Deskriptif - Raw Data
                                        </span>
                                    </div>
                                    <input type="text" name="kondisi_pinjam_raw" id="kondisi_pinjam_raw"
                                        placeholder="Misal: Normal, sedikit lecet, atau ada goresan"
                                        class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Akan dinormalisasi menjadi kondisi standar</p>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Detail Transaksi -->
                        <div class="space-y-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 dark:text-white">
                                    Detail Transaksi Peminjaman
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Tanggal Pinjam -->
                                <div class="space-y-2">
                                    <label for="tgl_pinjam" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        Tanggal Pinjam <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input type="date" name="tgl_pinjam" id="tgl_pinjam" required
                                            class="pl-10 mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                    </div>
                                </div>

                                <!-- Rencana Kembali -->
                                <div class="space-y-2">
                                    <label for="tgl_kembali_rencana" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        Rencana Kembali <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <input type="date" name="tgl_kembali_rencana" id="tgl_kembali_rencana" required
                                            class="pl-10 mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm">
                                    </div>
                                </div>

                                <!-- Keperluan -->
                                <div class="md:col-span-2 space-y-2">
                                    <label for="keperluan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        Keperluan Peminjaman
                                    </label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <textarea id="keperluan" name="keperluan" rows="3"
                                            placeholder="Contoh: Praktikum Fisika Dasar Modul 3, Penelitian Skripsi, atau Tugas Kelompok"
                                            class="pl-10 mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 sm:text-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="pt-8 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row justify-end gap-3">
                                <button type="button" onclick="confirmCancel()"
                                    class="inline-flex justify-center items-center rounded-lg border border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-600 py-3 px-6 text-sm font-semibold text-slate-700 dark:text-white shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Batal
                                </button>
                                <button type="submit"
                                    class="inline-flex justify-center items-center rounded-lg border border-transparent bg-gradient-to-r from-blue-600 to-indigo-600 py-3 px-8 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                    </svg>
                                    Simpan Data Transaksi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Footer -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Pastikan semua data yang dimasukkan sudah benar sebelum disimpan.
                    <span class="font-medium text-blue-600 dark:text-blue-400">Data tidak dapat diubah setelah disimpan.</span>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set default dates
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tgl_pinjam').value = today;

    // Set default return date (7 days from now)
    // const nextWeek = new Date();
    // nextWeek.setDate(nextWeek.getDate() + 7);
    // document.getElementById('tgl_kembali_rencana').value = nextWeek.toISOString().split('T')[0];

    // Search NIM functionality with SweetAlert
    document.getElementById('search-nim').addEventListener('click', function() {
        const nim = document.getElementById('nim').value.trim();

        if (!nim) {
            Swal.fire({
                icon: 'warning',
                title: 'NIM Kosong',
                text: 'Masukkan NIM terlebih dahulu.',
                confirmButtonColor: '#3085d6',
            });
            return;
        }

        // Show loading
        Swal.fire({
            title: 'Mencari Data...',
            text: 'Sedang mencari data mahasiswa',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(`{{ route('api.mahasiswa.search') }}?nim=${encodeURIComponent(nim)}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            Swal.close();

            if (data.found) {
                // Fill form with data
                document.getElementById('nama').value = data.data.nama || '';
                document.getElementById('jurusan_raw').value = data.data.jurusan_raw || '';
                document.getElementById('angkatan').value = data.data.angkatan || '';
                document.getElementById('email').value = data.data.email || '';

                Swal.fire({
                    icon: 'success',
                    title: 'Data Ditemukan!',
                    text: 'Data mahasiswa berhasil dimuat.',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Data Tidak Ditemukan',
                    text: 'Mahasiswa dengan NIM tersebut tidak terdaftar. Silakan isi data manual.',
                    confirmButtonColor: '#3085d6',
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal mencari data. Periksa koneksi Anda.',
                confirmButtonColor: '#d33',
            });
            console.error('Error:', error);
        });
    });

    // Form submission with validation
    document.getElementById('peminjaman-form').addEventListener('submit', function(e) {
        const nim = document.getElementById('nim').value.trim();
        const nama = document.getElementById('nama').value.trim();
        const barang = document.getElementById('barang_id').value;
        const tglPinjam = document.getElementById('tgl_pinjam').value;
        const tglKembali = document.getElementById('tgl_kembali_rencana').value;

        // Basic validation
        if (!nim || !nama || !barang || !tglPinjam || !tglKembali) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Harap lengkapi semua field yang wajib diisi.',
                confirmButtonColor: '#3085d6',
            });
            return;
        }

        // Date validation
        if (new Date(tglKembali) < new Date(tglPinjam)) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Tanggal Tidak Valid',
                text: 'Tanggal rencana kembali tidak boleh sebelum tanggal pinjam.',
                confirmButtonColor: '#d33',
            });
        }
    });

    // Cancel confirmation
    window.confirmCancel = function() {
        Swal.fire({
            title: 'Batalkan Pengisian?',
            text: 'Semua data yang telah dimasukkan akan hilang.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Lanjutkan Edit'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route("dashboard") }}';
            }
        });
    };

    // Real-time form validation indicators
    const requiredFields = ['nim', 'nama', 'barang_id', 'tgl_pinjam', 'tgl_kembali_rencana'];

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    this.classList.add('border-red-300', 'dark:border-red-700');
                    this.classList.remove('border-gray-300', 'dark:border-gray-700');
                } else {
                    this.classList.remove('border-red-300', 'dark:border-red-700');
                    this.classList.add('border-gray-300', 'dark:border-gray-700');
                }
            });
        }
    });
});
</script>
