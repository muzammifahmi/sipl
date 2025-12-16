<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dataset Mentah (Raw Data)') }}
            </h2>
            {{-- Tombol Import --}}
            <button id="importBtn" class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                Import Excel / CSV
            </button>



            {{-- Hidden File Input --}}
            <input type="file" id="importFile" accept=".xlsx,.xls,.csv" class="hidden" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert Info (dynamic) --}}
            @php
                // Hitung jumlah baris yang memiliki NIM kosong (indikator data tidak lengkap)
                $nullCount = $rawData->filter(function($r) {
                    return empty($r->nim);
                })->count();

                $totalRows = $rawData->count();
                $completeRows = $totalRows - $nullCount;
            @endphp

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
                                Data belum lengkap. <span class="font-bold">{{ $nullCount }} dari {{ $totalRows }} baris</span> memiliki NIM kosong (ditandai merah).
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
                                Semua data terlihat lengkap — tidak ada NIM kosong. <span class="font-bold">{{ $completeRows }} data</span> siap diproses.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Statistik Data --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
                            <div class="flex items-center">
                                <div class="bg-blue-100 dark:bg-blue-800 p-2 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-blue-600 dark:text-blue-400">Total Data</p>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalRows }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg border border-green-100 dark:border-green-800">
                            <div class="flex items-center">
                                <div class="bg-green-100 dark:bg-green-800 p-2 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-green-600 dark:text-green-400">Data Lengkap</p>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $completeRows }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg border border-yellow-100 dark:border-yellow-800">
                            <div class="flex items-center">
                                <div class="bg-yellow-100 dark:bg-yellow-800 p-2 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-yellow-600 dark:text-yellow-400">Data Kosong</p>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $nullCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel Data Mentah --}}
                    <div class="overflow-x-auto">
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
                                {{-- Contoh Loop Data --}}
                                @foreach($rawData as $index => $row)
                                <tr class="transition duration-150 hover:bg-gray-100 dark:hover:bg-gray-700 hover:shadow-sm">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>

                                    {{-- Kolom Nama --}}
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $row->nama }}
                                    </td>

                                    {{-- Kolom NIM (highlight merah jika kosong) --}}
                                    <td class="px-6 py-4 {{ empty($row->nim) ? 'bg-red-50 text-red-600 font-bold' : '' }}">
                                        {{ $row->nim ?? 'NULL' }}
                                    </td>

                                    {{-- Kolom Jurusan Raw --}}
                                    <td class="px-6 py-4">
                                        {{ $row->jurusan_raw ?? '-' }}
                                    </td>

                                    {{-- Kolom Angkatan --}}
                                    <td class="px-6 py-4">
                                        {{ $row->angkatan ?? '-' }}
                                    </td>

                                    {{-- Indikator Validitas: Nama dan NIM harus ada --}}
                                    <td class="px-6 py-4 text-center">
                                        @if(!empty($row->nama) && !empty($row->nim))
                                            <span class="text-green-500" title="Data Lengkap">
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
                    </div>

                    {{-- Action Footer --}}
                    <div class="mt-6 pt-6 border-t border-gray-100 flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Menampilkan {{ $rawData->count() }} data mentah
                        </div>
                        <div class="flex gap-3">
                            <button onclick="konfirmasiPreprocessing()"
                                    class="flex items-center px-6 py-3 bg-slate-800 dark:bg-slate-200 text-white dark:text-slate-800 rounded-md font-bold text-sm shadow-lg hover:bg-slate-700 transition"
                                    {{ $completeRows == 0 ? 'disabled' : '' }}>
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                Jalankan Preprocessing
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Form Preprocessing (hidden) --}}
    <form id="preprocessForm" method="POST" action="{{ route('mahasiswa.preprocess') }}" class="hidden">
        @csrf
    </form>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Fungsi untuk konfirmasi import
document.getElementById('importBtn').addEventListener('click', function() {
    document.getElementById('importFile').click();
});

document.getElementById('importFile').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validasi tipe file
        const allowedTypes = [
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel',
            'text/csv',
            'application/vnd.ms-excel.sheet.macroEnabled.12',
            'application/vnd.ms-excel.sheet.binary.macroEnabled.12'
        ];

        const fileExtension = file.name.split('.').pop().toLowerCase();
        const isValidType = allowedTypes.includes(file.type) ||
                           fileExtension === 'csv' ||
                           fileExtension === 'xlsx' ||
                           fileExtension === 'xls';

        if (!isValidType) {
            Swal.fire({
                icon: 'error',
                title: 'Format File Tidak Didukung',
                html: `<div class="text-left">
                    <p>Silakan pilih file dengan format:</p>
                    <ul class="list-disc pl-5 mt-2 space-y-1">
                        <li>Excel (.xlsx, .xls)</li>
                        <li>CSV (.csv)</li>
                    </ul>
                    <p class="text-xs text-gray-500 mt-3">File yang Anda pilih: <strong>${file.name}</strong></p>
                </div>`,
                confirmButtonColor: '#4F46E5',
                width: '450px'
            });
            this.value = ''; // Reset input
            return;
        }

        // Validasi ukuran file (max 10MB)
        if (file.size > 10 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'File Terlalu Besar',
                html: `<div class="text-left">
                    <p>Ukuran file maksimal 10MB.</p>
                    <div class="bg-red-50 p-3 rounded mt-2">
                        <p class="text-sm">Ukuran file Anda: <strong>${(file.size / (1024*1024)).toFixed(2)} MB</strong></p>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Silakan kompres file atau gunakan file yang lebih kecil.</p>
                </div>`,
                confirmButtonColor: '#4F46E5',
                width: '450px'
            });
            this.value = '';
            return;
        }

        // Tampilkan preview data
        const reader = new FileReader();
        reader.onload = function(event) {
            const content = event.target.result;

            // Untuk file CSV, baca beberapa baris pertama
            let previewText = '';
            if (fileExtension === 'csv') {
                const lines = content.split('\n').slice(0, 6);
                previewText = lines.join('\n');
            }

            Swal.fire({
                title: 'Konfirmasi Import Data',
                html: `<div class="text-left">
                    <p class="mb-3">Anda akan mengimport file:</p>

                    <div class="bg-gray-50 p-3 rounded mb-3">
                        <p class="font-semibold text-gray-800">${file.name}</p>
                        <p class="text-sm text-gray-600">Ukuran: ${(file.size / 1024).toFixed(0)} KB • Jenis: ${fileExtension.toUpperCase()}</p>
                    </div>

                    ${previewText ? `
                    <div class="mb-3">
                        <p class="text-sm font-medium mb-1">Preview Data:</p>
                        <div class="bg-slate-50 p-3 rounded border border-slate-200 max-h-40 overflow-auto">
                            <pre class="text-xs font-mono">${previewText}</pre>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Menampilkan 6 baris pertama</p>
                    </div>
                    ` : ''}

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                        <p class="text-sm text-yellow-700">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <strong>Catatan:</strong> Data yang sudah ada tidak akan dihapus, hanya ditambahkan.
                        </p>
                    </div>
                </div>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4F46E5',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Import Sekarang',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                width: '550px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat FormData untuk upload
                    const formData = new FormData();
                    formData.append('file', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    // Tampilkan loading dengan progress
                    let timerInterval;
                    Swal.fire({
                        title: 'Mengimport Data...',
                        html: `
                            <div class="text-left">
                                <p>Memproses file <strong>${file.name}</strong></p>
                                <div class="mt-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div id="import-progress-bar" class="bg-indigo-600 h-2 rounded-full" style="width: 0%"></div>
                                    </div>
                                    <p id="import-progress-text" class="text-xs text-center mt-2 text-gray-600">0% • Memulai...</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-4">Harap tunggu, proses mungkin memakan waktu beberapa saat.</p>
                            </div>
                        `,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            // Simulasi progress bar
                            let progress = 0;
                            timerInterval = setInterval(() => {
                                progress += Math.random() * 10;
                                if (progress > 90) progress = 90;

                                const progressBar = document.getElementById('import-progress-bar');
                                const progressText = document.getElementById('import-progress-text');

                                if (progressBar && progressText) {
                                    progressBar.style.width = `${progress}%`;
                                    progressText.textContent = `${Math.round(progress)}% • Memproses data...`;
                                }
                            }, 300);
                        }
                    });

                    // Kirim file ke server
                    fetch('{{ route("preprocessing.import") }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        clearInterval(timerInterval);
                        return response.json();
                    })
                    .then(data => {
                        Swal.close();

                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Import Berhasil!',
                                html: `<div class="text-left">
                                    <p>${data.message}</p>
                                    <div class="bg-green-50 p-3 rounded mt-3">
                                        <p class="text-sm"><strong>Ringkasan:</strong></p>
                                        <ul class="text-xs text-gray-700 space-y-1 mt-1">
                                            <li>Total baris diproses: ${data.total_rows || 0}</li>
                                            <li>Data berhasil disimpan: ${data.saved_rows || 0}</li>
                                            ${data.duplicates ? `<li>Data duplikat ditemukan: ${data.duplicates}</li>` : ''}
                                            ${data.errors ? `<li>Gagal diproses: ${data.errors}</li>` : ''}
                                        </ul>
                                    </div>
                                </div>`,
                                confirmButtonColor: '#10B981',
                                width: '500px'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Import Gagal',
                                html: `<div class="text-left">
                                    <p>${data.message || 'Terjadi kesalahan saat mengimport data'}</p>
                                    ${data.errors ? `
                                    <div class="bg-red-50 p-3 rounded mt-3">
                                        <p class="text-sm font-semibold">Detail Error:</p>
                                        <p class="text-xs">${data.errors}</p>
                                    </div>
                                    ` : ''}
                                </div>`,
                                confirmButtonColor: '#4F46E5'
                            });
                        }
                    })
                    .catch(error => {
                        clearInterval(timerInterval);
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            html: `<div class="text-left">
                                <p>Gagal mengimport file. Silakan coba lagi.</p>
                                <div class="bg-gray-50 p-3 rounded mt-3">
                                    <p class="text-xs">Pesan error: ${error.message}</p>
                                </div>
                            </div>`,
                            confirmButtonColor: '#4F46E5',
                            width: '450px'
                        });
                    });
                }
            });
        };

        if (fileExtension === 'csv') {
            reader.readAsText(file);
        } else {
            Swal.fire({
                title: 'Konfirmasi Import Data',
                html: `<div class="text-left">
                    <p class="mb-3">Anda akan mengimport file Excel:</p>
                    <div class="bg-gray-50 p-3 rounded mb-3">
                        <p class="font-semibold text-gray-800">${file.name}</p>
                        <p class="text-sm text-gray-600">Ukuran: ${(file.size / 1024).toFixed(0)} KB</p>
                    </div>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                        <p class="text-sm text-yellow-700">
                            <strong>Pastikan struktur kolom sesuai:</strong> Nama, NIM, Jurusan, Angkatan
                        </p>
                    </div>
                </div>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4F46E5',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Import Sekarang',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                width: '500px'
            }).then((result) => {
                if (result.isConfirmed) {
                    uploadFile(file);
                }
            });
        }
    }
});

// Fungsi untuk upload file
function uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', '{{ csrf_token() }}');

    Swal.fire({
        title: 'Mengimport Excel...',
        html: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('{{ route("preprocessing.import") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        Swal.close();
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                html: `<div class="text-left">
                    <p>${data.message}</p>
                    <div class="bg-green-50 p-3 rounded mt-3">
                        <p class="text-sm"><strong>Hasil Import:</strong></p>
                        <ul class="text-xs text-gray-700 space-y-1 mt-1">
                            <li>Total data: ${data.total_rows || 0}</li>
                            <li>Berhasil: ${data.saved_rows || 0}</li>
                            ${data.skipped ? `<li>Data duplikat: ${data.skipped}</li>` : ''}
                        </ul>
                    </div>
                </div>`,
                confirmButtonColor: '#10B981'
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: data.message || 'Terjadi kesalahan',
                confirmButtonColor: '#4F46E5'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengupload file',
            confirmButtonColor: '#4F46E5'
        });
    });
}

// Fungsi untuk konfirmasi preprocessing
function konfirmasiPreprocessing() {
    const completeRows = {{ $completeRows }};
    const nullCount = {{ $nullCount }};

    if (completeRows === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Tidak Ada Data Lengkap',
            html: `<div class="text-left">
                <p>Tidak ada data yang dapat diproses karena semua data memiliki NIM kosong.</p>
                <div class="bg-red-50 p-3 rounded mt-3">
                    <p class="text-sm">Data lengkap: <strong>0</strong></p>
                    <p class="text-sm">Data kosong: <strong>${nullCount}</strong></p>
                </div>
                <p class="text-xs text-gray-500 mt-3">Harap lengkapi data NIM terlebih dahulu.</p>
            </div>`,
            confirmButtonColor: '#4F46E5',
            width: '450px'
        });
        return;
    }

    Swal.fire({
        title: 'Jalankan Preprocessing',
        html: `<div class="text-left">
            <p>Anda akan memproses <strong>${completeRows} data lengkap</strong> untuk membersihkan dan menstandarisasi.</p>

            <div class="bg-blue-50 p-3 rounded my-3">
                <p class="text-sm font-semibold mb-2">Apa yang akan dilakukan:</p>
                <ul class="text-xs text-gray-700 space-y-1">
                    <li>✓ Membersihkan format NIM</li>
                    <li>✓ Menstandarisasi format nama</li>
                    <li>✓ Memisahkan jurusan dari fakultas</li>
                    <li>✓ Menghapus data duplikat</li>
                </ul>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                <p class="text-sm text-yellow-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <strong>Perhatian:</strong> Proses ini akan mengubah data mentah menjadi data terstruktur.
                </p>
            </div>
        </div>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#4F46E5',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Jalankan Preprocessing',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        width: '500px'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading dengan progress bar
            Swal.fire({
                title: 'Memproses Data...',
                html: `
                    <div class="text-left">
                        <p>Membersihkan dan menstandarisasi ${completeRows} data</p>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div id="process-progress-bar" class="bg-indigo-600 h-2 rounded-full" style="width: 0%"></div>
                            </div>
                            <p id="process-progress-text" class="text-xs text-center mt-2 text-gray-600">0% • Memulai...</p>
                        </div>
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center text-sm">
                                <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span>Membersihkan nama...</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center mr-2">
                                    <span class="text-xs text-gray-500">2</span>
                                </div>
                                <span>Memformat NIM...</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center mr-2">
                                    <span class="text-xs text-gray-500">3</span>
                                </div>
                                <span>Memisahkan jurusan...</span>
                            </div>
                        </div>
                    </div>
                `,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    // Simulasi progress
                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += 10;
                        if (progress > 100) progress = 100;

                        const progressBar = document.getElementById('process-progress-bar');
                        const progressText = document.getElementById('process-progress-text');

                        if (progressBar && progressText) {
                            progressBar.style.width = `${progress}%`;
                            progressText.textContent = `${progress}% • Memproses...`;
                        }

                        if (progress >= 100) {
                            clearInterval(interval);
                        }
                    }, 200);
                }
            });

            // Submit form preprocessing
            setTimeout(() => {
                document.getElementById('preprocessForm').submit();
            }, 1500);
        }
    });
}

// Flash Messages dengan SweetAlert
@if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#f0fdf4',
        iconColor: '#10B981',
        color: '#065F46',
    });
@endif

@if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        background: '#FEF2F2',
        iconColor: '#EF4444',
        color: '#991B1B',
    });
@endif

@if (session('warning'))
    Swal.fire({
        icon: 'warning',
        title: 'Perhatian!',
        text: '{{ session('warning') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        background: '#FFFBEB',
        iconColor: '#F59E0B',
        color: '#92400E',
    });
@endif

@if (session('info'))
    Swal.fire({
        icon: 'info',
        title: 'Informasi',
        text: '{{ session('info') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#EFF6FF',
        iconColor: '#3B82F6',
        color: '#1E40AF',
    });
@endif
</script>
