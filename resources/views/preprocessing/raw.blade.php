<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dataset Mentah (Raw Data)') }}
            </h2>
            {{-- Tombol Aksi --}}
            <div class="flex items-center space-x-3">
                {{-- Tombol Import --}}
                <button id="importBtn" class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Import Excel / CSV
                </button>

                {{-- Hidden File Input --}}
                <input type="file" id="importFile" accept=".xlsx,.xls,.csv" class="hidden" />

                {{-- Tombol Preprocessing --}}
                <form method="POST" action="{{ route('mahasiswa.preprocess') }}" class="inline" id="preprocessForm">
                    @csrf
                    <button type="button" id="preprocessBtn"
                        class="flex items-center px-4 py-2 bg-slate-800 dark:bg-slate-200 text-white dark:text-slate-800 rounded-md font-bold text-sm shadow-lg hover:bg-slate-700 transition">
                        <i class="mr-2 not-italic">✨</i> Jalankan Preprocessing
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert Import Success --}}
            @if(session('import_success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                <strong>Import Berhasil!</strong> {{ session('import_success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Alert Import Error --}}
            @if(session('import_error'))
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                <strong>Import Gagal!</strong> {{ session('import_error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Alert Preprocessing Success --}}
            @if(session('preprocessing_success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded shadow-sm">
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
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded shadow-sm">
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

            {{-- Alert Warning: Data Kosong --}}
            @if($rawData->isEmpty())
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Dataset Kosong!</strong> Tidak ada data yang ditemukan. Silakan import data terlebih dahulu.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                {{-- Hitung jumlah baris yang memiliki NIM kosong --}}
                @php
                    $nullCount = $rawData->filter(function($r) {
                        return empty($r->nim);
                    })->count();

                    $totalData = $rawData->count();
                    $validData = $totalData - $nullCount;
                @endphp

                {{-- Alert Info: Status Data --}}
                @if($nullCount > 0)
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Perhatian!</strong> Terdapat <span class="font-bold">{{ $nullCount }} dari {{ $totalData }} data</span> yang memiliki NIM kosong (ditandai merah).
                                    Hanya <span class="font-bold">{{ $validData }} data</span> yang valid untuk preprocessing.
                                </p>
                                <p class="text-xs text-yellow-600 mt-1">
                                    <i>Data dengan NIM kosong akan diabaikan saat preprocessing.</i>
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">
                                    <strong>Data Lengkap!</strong> Semua <span class="font-bold">{{ $totalData }} data</span> memiliki NIM dan siap untuk preprocessing.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Alert Info: Duplikat NIM --}}
                @php
                    // Cek duplikat NIM (kecuali yang kosong)
                    $nimCounts = $rawData->whereNotNull('nim')->countBy('nim');
                    $duplicateNims = $nimCounts->filter(function($count) {
                        return $count > 1;
                    });

                    $duplicateCount = $duplicateNims->count();
                @endphp

                @if($duplicateCount > 0)
                    <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-6 rounded shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-orange-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-orange-700">
                                    <strong>Peringatan Duplikat!</strong> Ditemukan <span class="font-bold">{{ $duplicateCount }} NIM yang terduplikasi</span>.
                                </p>
                                <details class="mt-2">
                                    <summary class="text-xs text-orange-600 cursor-pointer hover:text-orange-800">
                                        Klik untuk melihat detail duplikat
                                    </summary>
                                    <ul class="text-xs text-orange-600 mt-1 ml-4 list-disc">
                                        @foreach($duplicateNims as $nim => $count)
                                            <li>NIM <strong>{{ $nim }}</strong> muncul {{ $count }} kali</li>
                                        @endforeach
                                    </ul>
                                </details>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            {{-- Alert Success Umum --}}
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded shadow-sm">
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

            {{-- Alert Error Umum --}}
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded shadow-sm">
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

            {{-- Alert Info Umum --}}
            @if(session('info'))
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded shadow-sm">
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Statistik Data --}}
                    @if(!$rawData->isEmpty())
                        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-blue-50 dark:bg-blue-900/30 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-blue-800 dark:text-blue-300">Total Data</p>
                                        <p class="text-lg font-bold text-blue-900 dark:text-blue-100">{{ $totalData }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 dark:bg-green-900/30 p-4 rounded-lg border border-green-100 dark:border-green-800">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800 dark:text-green-300">Data Valid</p>
                                        <p class="text-lg font-bold text-green-900 dark:text-green-100">{{ $validData }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-red-50 dark:bg-red-900/30 p-4 rounded-lg border border-red-100 dark:border-red-800">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-red-800 dark:text-red-300">Data Tidak Valid</p>
                                        <p class="text-lg font-bold text-red-900 dark:text-red-100">{{ $nullCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Tabel Data Mentah --}}
                    <div class="overflow-x-auto">
                        @if($rawData->isEmpty())
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada data</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Mulai dengan mengimport file Excel atau CSV.
                                </p>
                                <div class="mt-6">
                                    <button id="emptyImportBtn" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                        Import Data Pertama
                                    </button>
                                </div>
                            </div>
                        @else
                            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                                <thead class="bg-slate-100 dark:bg-gray-700 text-slate-500 dark:text-slate-300 uppercase font-bold text-xs">
                                    <tr>
                                        <th class="px-6 py-4">No</th>
                                        <th class="px-6 py-4">Nama Lengkap</th>
                                        <th class="px-6 py-4">NIM</th>
                                        <th class="px-6 py-4">Jurusan (Raw)</th>
                                        <th class="px-6 py-4">Angkatan</th>
                                        <th class="px-6 py-4 text-center">Validitas</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @foreach($rawData as $index => $row)
                                    <tr class="transition duration-150 hover:bg-gray-100 dark:hover:bg-gray-700 hover:shadow-sm">
                                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $row->nama }}
                                        </td>
                                        <td class="px-6 py-4 {{ empty($row->nim) ? 'bg-red-50 text-red-600 font-bold' : '' }}">
                                            {{ $row->nim ?? 'NULL' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $row->jurusan_raw ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $row->angkatan ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if(!empty($row->nama) && !empty($row->nim))
                                                <span class="text-green-500">
                                                    <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </span>
                                            @else
                                                <span class="text-red-500" title="Data tidak lengkap">
                                                    <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                            @if(method_exists($rawData, 'links'))
                                <div class="mt-6 px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                                    {{ $rawData->links() }}
                                </div>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Import dan Preprocessing --}}
    <script>
        // Import file
        document.getElementById('importBtn').addEventListener('click', function() {
            document.getElementById('importFile').click();
        });

        // Tambah event listener untuk tombol import di area kosong
        const emptyImportBtn = document.getElementById('emptyImportBtn');
        if (emptyImportBtn) {
            emptyImportBtn.addEventListener('click', function() {
                document.getElementById('importFile').click();
            });
        }

        // Handle file import
        document.getElementById('importFile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                importFile(file);
            }
        });

        // Preprocessing confirmation
        document.getElementById('preprocessBtn').addEventListener('click', function(e) {
            e.preventDefault();

            @if($rawData->isEmpty())
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Ada Data',
                    text: 'Tidak ada data untuk diproses. Silakan import data terlebih dahulu.',
                    confirmButtonColor: '#4F46E5'
                });
                return;
            @endif

            @if($validData === 0)
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Ada Data Valid',
                    html: `<div class="text-left">
                        <p>Tidak ada data yang valid untuk diproses.</p>
                        <p class="text-sm text-gray-600 mt-2">Semua data memiliki NIM kosong.</p>
                    </div>`,
                    confirmButtonColor: '#4F46E5'
                });
                return;
            @endif

            Swal.fire({
                title: 'Konfirmasi Preprocessing',
                html: `<div class="text-left">
                    <p class="mb-3">Anda akan menjalankan preprocessing pada <strong>${@json($validData)} data valid</strong>.</p>
                    <p class="text-sm text-gray-600 mb-1">• Data dengan NIM kosong akan diabaikan</p>
                    <p class="text-sm text-gray-600 mb-1">• Data duplikat akan dihapus</p>
                    <p class="text-sm text-gray-600">• Jurusan akan dinormalisasi</p>
                    <div class="mt-4 p-3 bg-blue-50 rounded">
                        <p class="text-sm font-medium text-blue-800">Proses ini akan memindahkan data valid ke tabel mahasiswa.</p>
                    </div>
                </div>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4F46E5',
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
                                <svg class="animate-spin h-10 w-10 text-indigo-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Sedang memproses ${@json($validData)} data...</p>
                            <p class="text-sm text-gray-500 mt-2">Proses mungkin memerlukan beberapa saat</p>
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

        // Function to handle file import
        function importFile(file) {
            // Validasi tipe file
            const allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel', 'text/csv'];
            if (!allowedTypes.includes(file.type) && !file.name.endsWith('.csv')) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Tidak Valid',
                    text: 'Silakan pilih file Excel (.xlsx, .xls) atau CSV (.csv)',
                    confirmButtonColor: '#4F46E5'
                });
                return;
            }

            // Validasi ukuran file (max 10MB)
            if (file.size > 10 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar',
                    text: 'Ukuran file maksimal 10MB',
                    confirmButtonColor: '#4F46E5'
                });
                return;
            }

            // Konfirmasi upload
            Swal.fire({
                title: 'Konfirmasi Import',
                html: `<div class="text-left">
                    <p class="mb-2">Apakah Anda yakin ingin mengimport file:</p>
                    <p class="font-bold mb-3">"${file.name}"</p>
                    <p class="text-sm text-gray-600 mb-1">• Ukuran: ${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                    <p class="text-sm text-gray-600">• Tipe: ${file.type || 'CSV/TEXT'}</p>
                    <p class="mt-3 text-sm text-yellow-600 font-medium">Data yang ada akan ditambahkan (tidak menggantikan).</p>
                </div>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4F46E5',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Import Sekarang',
                cancelButtonText: 'Batal',
                width: '500px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat FormData untuk upload
                    const formData = new FormData();
                    formData.append('file', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    // Tampilkan loading
                    Swal.fire({
                        title: 'Mengimport Data...',
                        html: `<div class="text-center">
                            <div class="mb-4">
                                <svg class="animate-spin h-10 w-10 text-indigo-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Sedang memproses file...</p>
                            <p class="text-sm text-gray-500 mt-2">Mohon tunggu sebentar</p>
                        </div>`,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        backdrop: true
                    });

                    // Kirim file ke server
                    fetch('{{ route("preprocessing.import") }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Import Berhasil!',
                                html: `<div class="text-left">
                                    <p class="mb-2">${data.message}</p>
                                    ${data.stats ? `
                                    <div class="mt-3 p-3 bg-green-50 rounded">
                                        <p class="text-sm font-medium text-green-800">Statistik Import:</p>
                                        <ul class="text-sm text-green-700 mt-1 space-y-1">
                                            <li>• Data baru ditambahkan: <strong>${data.stats.added}</strong></li>
                                            ${data.stats.duplicates ? `<li>• Duplikat diabaikan: <strong>${data.stats.duplicates}</strong></li>` : ''}
                                            ${data.stats.errors ? `<li>• Error: <strong>${data.stats.errors}</strong></li>` : ''}
                                        </ul>
                                    </div>
                                    ` : ''}
                                </div>`,
                                confirmButtonColor: '#4F46E5',
                                confirmButtonText: 'Lihat Data'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            let errorMessage = data.message || 'Terjadi kesalahan saat mengimport data';
                            if (data.errors) {
                                errorMessage += '<br><ul class="mt-2 text-sm text-left">';
                                for (const [key, errors] of Object.entries(data.errors)) {
                                    errorMessage += `<li>• ${errors.join(', ')}</li>`;
                                }
                                errorMessage += '</ul>';
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Import Gagal',
                                html: errorMessage,
                                confirmButtonColor: '#4F46E5'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal mengimport file. Silakan coba lagi.',
                            confirmButtonColor: '#4F46E5'
                        });
                    });
                }
            });
        }
    </script>
</x-app-layout>
