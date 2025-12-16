<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-800 dark:text-white leading-tight">
                {{ __('Data Master Mahasiswa (User)') }}
            </h2>

            <form action="{{ route('mahasiswa.preprocess') }}" method="POST" id="preprocessForm">
                @csrf
                <button type="button" id="preprocessBtn"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v4" />
                        <path d="m16.2 7.8 2.9-2.9" />
                        <path d="M18 12h4" />
                        <path d="m16.2 16.2 2.9 2.9" />
                        <path d="M12 18v4" />
                        <path d="m4.9 19.1 2.9-2.9" />
                        <path d="M2 12h4" />
                        <path d="m4.9 4.9 2.9 2.9" />
                    </svg>
                    Jalankan Preprocessing
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert Preprocessing Success --}}
            @if(session('preprocessing_success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                <strong>Preprocessing Berhasil!</strong> {{ session('preprocessing_success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Alert Preprocessing Error --}}
            @if(session('preprocessing_error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                <strong>Preprocessing Gagal!</strong> {{ session('preprocessing_error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Alert Info --}}
            @if(session('info'))
                <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                {{ session('info') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Alert Warning: Data Belum Dipreprocess --}}
            @php
                $unprocessedCount = $mahasiswas->whereNull('jurusan_clean')->count();
                $totalData = $mahasiswas->count();
            @endphp

            @if($unprocessedCount > 0)
                <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Perhatian!</strong> Terdapat <span class="font-bold">{{ $unprocessedCount }} dari {{ $totalData }} data</span> yang belum dipreprocess.
                            </p>
                            <p class="text-xs text-yellow-600 mt-1">
                                Jalankan preprocessing untuk membersihkan dan menormalisasi data jurusan.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                            <thead
                                class="bg-slate-50 dark:bg-gray-700 text-slate-500 dark:text-slate-300 uppercase font-bold text-xs">
                                <tr>
                                    <th class="px-6 py-4 rounded-tl-lg">Identitas (NIM)</th>
                                    <th class="px-6 py-4">Nama & Email</th>
                                    <th class="px-6 py-4">Angkatan</th>
                                    <th
                                        class="px-6 py-4 bg-blue-50 dark:bg-blue-900/20 border-l border-blue-100 dark:border-blue-800">
                                        Data Jurusan (Raw vs Clean)
                                    </th>
                                    <th class="px-6 py-4 rounded-tr-lg text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($mahasiswas as $mhs)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-700/50 transition duration-150">
                                        <td
                                            class="px-6 py-4 font-mono font-semibold text-slate-700 dark:text-slate-300">
                                            {{ $mhs->nim }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="font-bold text-slate-900 dark:text-white text-base">
                                                {{ $mhs->nama }}
                                            </div>
                                            <div class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                                </svg>
                                                {{ $mhs->email }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $mhs->angkatan }}
                                            </span>
                                        </td>

                                        <td
                                            class="px-6 py-4 bg-blue-50/30 dark:bg-blue-900/10 border-l border-blue-100 dark:border-blue-800">
                                            <div class="flex flex-col gap-2">
                                                <div class="text-xs">
                                                    <span class="text-slate-400 uppercase text-[10px] font-bold">Input
                                                        User (Raw):</span>
                                                    <div
                                                        class="italic text-red-500 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded border border-red-100 dark:border-red-800 mt-1">
                                                        {{ $mhs->jurusan_raw }}
                                                    </div>
                                                </div>

                                                <div class="text-xs">
                                                    <span class="text-slate-400 uppercase text-[10px] font-bold">Hasil
                                                        Sistem (Clean):</span>
                                                    @if ($mhs->jurusan_clean)
                                                        <div
                                                            class="font-bold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded border border-green-100 dark:border-green-800 mt-1 flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <polyline points="20 6 9 17 4 12" />
                                                            </svg>
                                                            {{ $mhs->jurusan_clean }}
                                                        </div>
                                                    @else
                                                        <div class="mt-1 text-slate-400 italic flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-3 h-3 animate-spin" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                                                            </svg>
                                                            Belum dipreprocess
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- Tombol Edit - Modal Trigger -->
                                                <button type="button" onclick="openEditModal({{ json_encode($mhs) }})"
                                                    class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-full transition"
                                                    title="Edit Data">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                                    </svg>
                                                </button>

                                                <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                                    onsubmit="return confirmDelete(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-full transition"
                                                        title="Hapus Data">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M3 6h18" />
                                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-12 w-12 text-slate-300 mb-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <p class="text-base font-medium">Belum ada data mahasiswa.</p>
                                                <p class="text-sm mt-1">Lakukan input peminjaman, data mahasiswa akan
                                                    otomatis tersimpan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $mahasiswas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mahasiswa -->
    <div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit Data Mahasiswa</h3>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label for="edit_nim" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            NIM
                        </label>
                        <input type="text" id="edit_nim" name="nim"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" id="edit_nama" name="nama"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="edit_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Email
                        </label>
                        <input type="email" id="edit_email" name="email"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="edit_angkatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Angkatan
                        </label>
                        <input type="number" id="edit_angkatan" name="angkatan" min="2000" max="2030"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="edit_jurusan_raw" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Jurusan (Raw)
                        </label>
                        <input type="text" id="edit_jurusan_raw" name="jurusan_raw"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>
                    <!-- Jurusan Clean tidak perlu diisi manual oleh user -->
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preprocessing confirmation
        document.getElementById('preprocessBtn').addEventListener('click', function(e) {
            e.preventDefault();

            @if($mahasiswas->isEmpty())
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Ada Data',
                    text: 'Tidak ada data mahasiswa untuk diproses.',
                    confirmButtonColor: '#7C3AED'
                });
                return;
            @endif

            Swal.fire({
                title: 'Konfirmasi Preprocessing',
                html: `<div class="text-left">
                    <p class="mb-3">Anda akan menjalankan preprocessing pada data mahasiswa.</p>
                    <p class="text-sm text-gray-600 mb-1">• Jurusan akan dinormalisasi</p>
                    <p class="text-sm text-gray-600 mb-1">• Data akan dibersihkan</p>
                    <p class="text-sm text-gray-600">• Konsistensi data akan diperiksa</p>
                    <div class="mt-4 p-3 bg-purple-50 dark:bg-purple-900/20 rounded">
                        <p class="text-sm font-medium text-purple-800 dark:text-purple-300">Proses ini akan memperbarui kolom jurusan_clean.</p>
                    </div>
                </div>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#7C3AED',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Jalankan Preprocessing',
                cancelButtonText: 'Batal',
                width: '500px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Memproses Data...',
                        html: `<div class="text-center">
                            <div class="mb-4">
                                <svg class="animate-spin h-10 w-10 text-purple-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">Sedang memproses data...</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Proses mungkin memerlukan beberapa saat</p>
                        </div>`,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        backdrop: true
                    });

                    // Submit form
                    document.getElementById('preprocessForm').submit();
                }
            });
        });

        // Confirm delete
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;

            Swal.fire({
                title: 'Hapus Data Mahasiswa?',
                html: `<div class="text-left">
                    <p class="mb-3">Data yang dihapus tidak dapat dikembalikan.</p>
                    <p class="text-sm text-gray-600 mb-1">• Data mahasiswa akan dihapus</p>
                    <p class="text-sm text-gray-600">• Riwayat peminjaman terkait juga akan terhapus</p>
                    <div class="mt-4 p-3 bg-red-50 dark:bg-red-900/20 rounded">
                        <p class="text-sm font-medium text-red-800 dark:text-red-300">Pastikan data ini tidak digunakan dalam peminjaman aktif.</p>
                    </div>
                </div>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                width: '500px'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Edit modal functions
        function openEditModal(mhs) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');

            // Set form action
            form.action = `/mahasiswa/${mhs.id}`;

            // Fill form fields (tidak termasuk jurusan_clean)
            document.getElementById('edit_nim').value = mhs.nim;
            document.getElementById('edit_nama').value = mhs.nama;
            document.getElementById('edit_email').value = mhs.email;
            document.getElementById('edit_angkatan').value = mhs.angkatan;
            document.getElementById('edit_jurusan_raw').value = mhs.jurusan_raw || '';

            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Handle edit form submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            Swal.fire({
                title: 'Menyimpan Perubahan...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#7C3AED'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    let errorMessage = data.message || 'Terjadi kesalahan saat menyimpan data';
                    if (data.errors) {
                        errorMessage += '<br><ul class="mt-2 text-sm text-left">';
                        for (const [key, errors] of Object.entries(data.errors)) {
                            errorMessage += `<li>• ${errors.join(', ')}</li>`;
                        }
                        errorMessage += '</ul>';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        html: errorMessage,
                        confirmButtonColor: '#7C3AED'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal menyimpan data. Silakan coba lagi.',
                    confirmButtonColor: '#7C3AED'
                });
            });
        });

        // Handle escape key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });
    </script>
</x-app-layout>
