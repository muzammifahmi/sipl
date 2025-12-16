<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-800 dark:text-white leading-tight">
                {{ __('Riwayat Transaksi Peminjaman') }}
            </h2>

            <a href="{{ route('peminjaman.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Input Peminjaman Baru
            </a>
        </div>
    </x-slot>

    {{-- Prevent FOUC for Alpine tabs --}}
    <style>[x-cloak]{display:none !important;}</style>

    {{-- LOGIC PEMISAHAN DATA (Hanya memfilter tampilan halaman ini) --}}
    @php
        $listDipinjam = $peminjamans->filter(fn($p) => $p->status == 'Dipinjam');
        $listKembali = $peminjamans->filter(fn($p) => $p->status == 'Kembali');
        // Asumsi 'Telat' adalah status selain Dipinjam dan Kembali
        $listTelat = $peminjamans->filter(fn($p) => $p->status != 'Dipinjam' && $p->status != 'Kembali');
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Flash Messages akan ditampilkan dengan SweetAlert di script --}}

            {{-- Statistik Ringkas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-yellow-900/10 dark:to-amber-900/10 border-l-4 border-yellow-500 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 dark:bg-yellow-900/30 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-yellow-600 dark:text-yellow-400">Sedang Dipinjam</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ count($listDipinjam) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/10 dark:to-emerald-900/10 border-l-4 border-green-500 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-green-600 dark:text-green-400">Sudah Kembali</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ count($listKembali) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/10 dark:to-rose-900/10 border-l-4 border-red-500 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-red-600 dark:text-red-400">Terlambat</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ count($listTelat) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Start Alpine Tabs --}}
            <div x-data="{ activeTab: 'dipinjam' }">

                {{-- Tab Navigation (Struktur seperti Tab Browser) --}}
                <div class="flex space-x-1 border-b border-gray-200 dark:border-gray-700 mb-0 px-2 overflow-x-auto">
                    <button @click="activeTab = 'dipinjam'"
                        :class="{
                            'bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 border-t border-l border-r border-gray-200 dark:border-gray-700 rounded-t-lg': activeTab ===
                                'dipinjam',
                            'bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:bg-gray-200': activeTab !==
                                'dipinjam'
                        }"
                        class="px-6 py-3 text-sm font-medium transition-colors duration-200 focus:outline-none flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                        Sedang Dipinjam
                        <span
                            class="ml-2 bg-gray-200 dark:bg-gray-700 text-xs px-2 py-0.5 rounded-full">{{ count($listDipinjam) }}</span>
                    </button>

                    <button @click="activeTab = 'kembali'"
                        :class="{
                            'bg-white dark:bg-gray-800 text-green-600 dark:text-green-400 border-t border-l border-r border-gray-200 dark:border-gray-700 rounded-t-lg': activeTab ===
                                'kembali',
                            'bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:bg-gray-200': activeTab !==
                                'kembali'
                        }"
                        class="px-6 py-3 text-sm font-medium transition-colors duration-200 focus:outline-none flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Sudah Kembali
                    </button>

                    <button @click="activeTab = 'telat'"
                        :class="{
                            'bg-white dark:bg-gray-800 text-red-600 dark:text-red-400 border-t border-l border-r border-gray-200 dark:border-gray-700 rounded-t-lg': activeTab ===
                                'telat',
                            'bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:bg-gray-200': activeTab !==
                                'telat'
                        }"
                        class="px-6 py-3 text-sm font-medium transition-colors duration-200 focus:outline-none flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Terlambat
                        @if (count($listTelat) > 0)
                            <span
                                class="ml-2 bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full">{{ count($listTelat) }}</span>
                        @endif
                    </button>
                </div>

                {{-- Container Tabel --}}
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-b-lg rounded-tr-lg border-l border-r border-b border-gray-100 dark:border-gray-700">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        {{-- Reuseable Table Head (Disederhanakan) --}}
                        @php
                            $tableHead = '
                            <thead class="bg-slate-50 dark:bg-gray-700 text-slate-500 dark:text-slate-300 uppercase font-bold text-xs">
                                <tr>
                                    <th class="px-6 py-4 rounded-tl-lg">Waktu Pinjam</th>
                                    <th class="px-6 py-4">Data Mahasiswa</th>
                                    <th class="px-6 py-4">Barang Dipinjam</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 rounded-tr-lg text-right">Aksi</th>
                                </tr>
                            </thead>';
                        @endphp

                        {{-- TAB CONTENT: DIPINJAM --}}
                        <div x-show="activeTab === 'dipinjam'" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                                    {!! $tableHead !!}
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @forelse ($listDipinjam as $pinjam)
                                            @include('peminjaman.partials.row-table', ['pinjam' => $pinjam])
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                        <p class="text-base font-medium text-gray-600">Tidak ada barang yang sedang dipinjam</p>
                                                        <p class="text-sm text-gray-500 mt-1">Semua alat sudah dikembalikan ke laboratorium</p>
                                                        <button onclick="showTutorialPeminjaman()" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200 transition">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            Lihat Cara Input Peminjaman
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- TAB CONTENT: KEMBALI --}}
                        <div x-show="activeTab === 'kembali'" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                                    {!! $tableHead !!}
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @forelse ($listKembali as $pinjam)
                                            @include('peminjaman.partials.row-table', ['pinjam' => $pinjam])
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <p class="text-base font-medium text-gray-600">Belum ada riwayat pengembalian</p>
                                                        <p class="text-sm text-gray-500 mt-1">Data pengembalian akan muncul di sini</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- TAB CONTENT: TELAT --}}
                        <div x-show="activeTab === 'telat'" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                                    {!! $tableHead !!}
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @forelse ($listTelat as $pinjam)
                                            @include('peminjaman.partials.row-table', ['pinjam' => $pinjam])
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-16 w-16 text-green-300 mb-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <p class="text-base font-medium text-green-600">Aman! Tidak ada yang terlambat</p>
                                                        <p class="text-sm text-gray-500 mt-1">Semua peminjaman sesuai jadwal</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination Links (Tetap di luar tab agar navigasi halaman jalan) --}}
                        <div class="mt-4 border-t pt-4">
                            {{ $peminjamans->links() }}
                            <p class="text-xs text-gray-400 mt-2 text-center italic">*Data dipisahkan berdasarkan halaman
                                saat ini.</p>
                        </div>

                    </div>
                </div>
            </div> {{-- End Alpine Tabs --}}
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Fungsi untuk menampilkan tutorial peminjaman
function showTutorialPeminjaman() {
    Swal.fire({
        title: 'Cara Input Peminjaman Baru',
        html: `<div class="text-left space-y-4">
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <h3 class="font-semibold text-blue-800 mb-2">Langkah-langkah:</h3>
                <ol class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 font-bold mr-2">1</span>
                        Klik tombol <strong>"Input Peminjaman Baru"</strong> di atas
                    </li>
                    <li class="flex items-start">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 font-bold mr-2">2</span>
                        Isi data mahasiswa (NIM, Nama, Jurusan, dll.)
                    </li>
                    <li class="flex items-start">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 font-bold mr-2">3</span>
                        Pilih alat lab yang akan dipinjam
                    </li>
                    <li class="flex items-start">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 font-bold mr-2">4</span>
                        Tentukan tanggal pinjam dan rencana kembali
                    </li>
                    <li class="flex items-start">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 font-bold mr-2">5</span>
                        Klik <strong>"Simpan Data Transaksi"</strong>
                    </li>
                </ol>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                <h3 class="font-semibold text-yellow-800 mb-2">Tips Penting:</h3>
                <ul class="space-y-1 text-sm text-gray-700">
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-yellow-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Gunakan tombol <strong>"Cari NIM"</strong> untuk mengisi data otomatis
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-yellow-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Pastikan alat tersedia (stok > 0) sebelum meminjam
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-yellow-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Isi kondisi alat untuk dokumentasi
                    </li>
                </ul>
            </div>

            <div class="bg-gray-50 p-4 rounded border">
                <p class="text-sm text-gray-600">
                    <strong>Catatan:</strong> Data peminjaman akan otomatis mengurangi stok alat dan dapat dikembalikan melalui tombol "Kembali" di tabel.
                </p>
            </div>
        </div>`,
        width: '600px',
        showConfirmButton: true,
        confirmButtonText: 'Mulai Input Peminjaman',
        confirmButtonColor: '#3B82F6',
        showCancelButton: true,
        cancelButtonText: 'Tutup',
        focusConfirm: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route("peminjaman.create") }}';
        }
    });
}

// Fungsi untuk konfirmasi hapus peminjaman
function konfirmasiHapusPeminjaman(event, id, namaMahasiswa, namaBarang, kodeBarang, kondisi, status, tanggalPinjam) {
    event.preventDefault();

    // Format tanggal
    const formatTanggal = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    // Tentukan warning berdasarkan status
    let warningMessage = '';
    if (status === 'Dipinjam') {
        warningMessage = `<div class="bg-red-50 border-l-4 border-red-500 p-3 my-3 rounded">
            <p class="text-sm text-red-700">
                <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.408 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <strong>PERINGATAN:</strong> Status peminjaman masih <strong>"DIPINJAM"</strong>
            </p>
            <p class="text-xs text-red-600 mt-1">Penghapusan akan mengembalikan stok barang ke inventaris.</p>
        </div>`;
    }

    Swal.fire({
        title: 'Konfirmasi Penghapusan Transaksi',
        html: `<div class="text-left">
            <p class="mb-3 text-red-600 font-semibold">PERHATIAN: Tindakan ini tidak dapat dibatalkan!</p>

            <div class="bg-gray-50 p-3 rounded mb-3">
                <p class="text-sm"><span class="font-medium">Mahasiswa:</span> ${namaMahasiswa}</p>
                <p class="text-sm"><span class="font-medium">Barang:</span> ${namaBarang}</p>
                <p class="text-sm"><span class="font-medium">Kode:</span> ${kodeBarang}</p>
                <p class="text-sm"><span class="font-medium">Kondisi Awal:</span>
                    <span class="px-2 py-0.5 rounded text-xs font-medium ${kondisi === 'Baik' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                        ${kondisi}
                    </span>
                </p>
                <p class="text-sm"><span class="font-medium">Status:</span>
                    <span class="px-2 py-0.5 rounded text-xs font-medium ${status === 'Dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'}">
                        ${status}
                    </span>
                </p>
                <p class="text-sm"><span class="font-medium">Tanggal Pinjam:</span> ${formatTanggal(tanggalPinjam)}</p>
            </div>

            ${warningMessage}

            <div class="bg-yellow-50 p-3 rounded">
                <p class="text-sm"><strong>Dampak Penghapusan:</strong></p>
                <ul class="text-xs text-gray-700 list-disc pl-4 mt-1 space-y-1">
                    <li>Data transaksi akan dihapus permanen</li>
                    <li>${status === 'Dipinjam' ? 'Stok barang akan dikembalikan ke inventaris' : 'Riwayat pengembalian akan hilang'}</li>
                    <li>Laporan statistik akan terpengaruh</li>
                    <li>Tidak dapat dikembalikan (permanen)</li>
                </ul>
            </div>
        </div>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus Permanen',
        cancelButtonText: 'Batalkan',
        reverseButtons: true,
        width: '550px',
        didOpen: () => {
            // Fokus ke tombol cancel untuk keamanan
            const cancelButton = Swal.getCancelButton();
            cancelButton.focus();
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Menghapus data transaksi peminjaman',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim request delete
            fetch(`/peminjaman/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menghapus data');
                }
                return response.json();
            })
            .then(data => {
                // Tutup loading
                Swal.close();

                if (data.success) {
                    // Tampilkan pesan sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message || 'Transaksi berhasil dihapus',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#f0fdf4',
                        iconColor: '#22c55e',
                        color: '#166534',
                    }).then(() => {
                        // Reload halaman
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat menghapus',
                        confirmButtonColor: '#ef4444'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message || 'Terjadi kesalahan saat menghapus data',
                    confirmButtonColor: '#ef4444'
                });
            });
        }
    });
}

// Fungsi untuk menampilkan detail peminjaman
function showDetailPeminjaman(id, nama, nim, barang, kondisi, status, tanggalPinjam, tanggalKembali, catatan = '', keperluan = '') {
    // Format tanggal
    const formatTanggal = (dateString) => {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    // Warna status
    const statusColors = {
        'Dipinjam': 'bg-yellow-100 text-yellow-800',
        'Kembali': 'bg-green-100 text-green-800',
        'Telat': 'bg-red-100 text-red-800'
    };

    const statusColor = statusColors[status] || 'bg-gray-100 text-gray-800';

    // Hitung selisih hari jika sudah kembali
    let selisihHari = '';
    if (status === 'Kembali' && tanggalKembali) {
        const tglPinjam = new Date(tanggalPinjam);
        const tglKembali = new Date(tanggalKembali);
        const diffTime = Math.abs(tglKembali - tglPinjam);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        selisihHari = `<p class="text-sm"><span class="font-medium">Durasi Pinjam:</span> ${diffDays} hari</p>`;
    }

    Swal.fire({
        title: 'Detail Peminjaman',
        html: `<div class="text-left space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Data Peminjam</h3>
                    <div class="bg-gray-50 p-3 rounded">
                        <p class="text-sm"><span class="font-medium">Nama:</span> ${nama}</p>
                        <p class="text-sm"><span class="font-medium">NIM:</span> <span class="font-mono">${nim}</span></p>
                    </div>
                </div>

                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Informasi Barang</h3>
                    <div class="bg-gray-50 p-3 rounded">
                        <p class="text-sm"><span class="font-medium">Barang:</span> ${barang}</p>
                        <p class="text-sm"><span class="font-medium">Kondisi Awal:</span>
                            <span class="px-2 py-0.5 rounded text-xs ${kondisi === 'Baik' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                ${kondisi}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Waktu Peminjaman</h3>
                    <div class="bg-blue-50 p-3 rounded">
                        <p class="text-sm">${formatTanggal(tanggalPinjam)}</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Waktu Pengembalian</h3>
                    <div class="${status === 'Kembali' ? 'bg-green-50' : 'bg-gray-50'} p-3 rounded">
                        <p class="text-sm">${tanggalKembali ? formatTanggal(tanggalKembali) : 'Belum dikembalikan'}</p>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <h3 class="font-semibold text-gray-700">Status</h3>
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full text-sm font-medium ${statusColor}">
                        ${status}
                    </span>
                    ${selisihHari}
                </div>
            </div>

            ${keperluan ? `
            <div class="space-y-2">
                <h3 class="font-semibold text-gray-700">Keperluan Peminjaman</h3>
                <div class="bg-purple-50 p-3 rounded">
                    <p class="text-sm">${keperluan}</p>
                </div>
            </div>
            ` : ''}

            ${catatan ? `
            <div class="space-y-2">
                <h3 class="font-semibold text-gray-700">Catatan</h3>
                <div class="bg-yellow-50 p-3 rounded">
                    <p class="text-sm">${catatan}</p>
                </div>
            </div>
            ` : ''}

            <div class="text-xs text-gray-500 pt-4 border-t">
                <p>ID Transaksi: ${id}</p>
            </div>
        </div>`,
        width: '600px',
        showConfirmButton: true,
        confirmButtonText: 'Tutup',
        confirmButtonColor: '#3b82f6',
        showCloseButton: true
    });
}

// Fungsi untuk form pengembalian yang lebih sederhana
function showFormPengembalian(event, id, nama, barang) {
    event.preventDefault();

    // Simple confirmation dialog
    Swal.fire({
        title: 'Konfirmasi Pengembalian',
        html: `
            <div class="text-left">
                <div class="bg-blue-50 p-3 rounded mb-4">
                    <p class="text-sm mb-2"><span class="font-semibold">Peminjam:</span> ${nama}</p>
                    <p class="text-sm"><span class="font-semibold">Barang:</span> ${barang}</p>
                </div>
                <p>Apakah Anda yakin ingin menandai peminjaman ini sebagai <strong>"Kembali"</strong>?</p>
                <p class="text-xs text-gray-500 mt-2">*Kondisi barang akan ditandai "Baik" secara default</p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Kembalikan',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        width: '450px'
    }).then((result) => {
        if (result.isConfirmed) {
            // Kirim data ke server
            fetch(`/peminjaman/${id}/kembali`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    kondisi: 'Baik',
                    catatan: 'Dikembalikan melalui konfirmasi sederhana'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#10b981'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat menyimpan data',
                        confirmButtonColor: '#ef4444'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    confirmButtonColor: '#ef4444'
                });
            });
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
        iconColor: '#22c55e',
        color: '#166534',
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
        background: '#fef2f2',
        iconColor: '#ef4444',
        color: '#991b1b',
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
        background: '#fffbeb',
        iconColor: '#f59e0b',
        color: '#92400e',
    });
@endif

// Notifikasi untuk peminjaman yang terlambat
@if(count($listTelat) > 0)
    Swal.fire({
        icon: 'warning',
        title: 'Ada Peminjaman Terlambat!',
        html: `<div class="text-left">
            <p>Terdapat <strong class="text-red-600">{{ count($listTelat) }} peminjaman</strong> yang melebihi batas waktu.</p>
            <div class="bg-red-50 p-3 rounded mt-3">
                <p class="text-sm">Silakan periksa tab <strong>"Terlambat"</strong> untuk detail lebih lanjut.</p>
            </div>
        </div>`,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'Lihat Detail',
        showCancelButton: true,
        cancelButtonText: 'Nanti Saja',
        width: '450px'
    }).then((result) => {
        if (result.isConfirmed) {
            // Set active tab to 'telat'
            document.querySelector('[x-data]').__x.$data.activeTab = 'telat';
        }
    });
@endif
</script>
