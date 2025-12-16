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

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

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

                        {{-- Reuseable Table Head --}}
                        @php
                            $tableHead = '
                            <thead class="bg-slate-50 dark:bg-gray-700 text-slate-500 dark:text-slate-300 uppercase font-bold text-xs">
                                <tr>
                                    <th class="px-6 py-4 rounded-tl-lg">Waktu Pinjam</th>
                                    <th class="px-6 py-4">Data Mahasiswa</th>
                                    <th class="px-6 py-4">Barang Dipinjam</th>
                                    <th class="px-6 py-4">Kondisi Awal</th>
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
                                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                                    <p>Tidak ada barang yang sedang dipinjam saat ini.</p>
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
                                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                                    <p>Belum ada riwayat pengembalian.</p>
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
                                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-12 w-12 text-green-300 mb-3" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <p class="text-base font-medium">Aman! Tidak ada yang terlambat.</p>
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
    // SweetAlert untuk Flash Messages
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

    // Fungsi untuk konfirmasi pengembalian
    function konfirmasiKembali(event, namaPeminjam, barang) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: 'Konfirmasi Pengembalian',
            html: `<div class="text-left">
                <p class="mb-2">Apakah Anda yakin ingin menandai peminjaman sebagai <strong>KEMBALI</strong>?</p>
                <div class="bg-blue-50 p-3 rounded mt-3">
                    <p class="text-sm"><span class="font-semibold">Peminjam:</span> ${namaPeminjam}</p>
                    <p class="text-sm"><span class="font-semibold">Barang:</span> ${barang}</p>
                </div>
            </div>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Tandai Kembali',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            width: '500px'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // Fungsi untuk konfirmasi penghapusan
    function konfirmasiHapus(event, namaPeminjam) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: 'Konfirmasi Penghapusan',
            html: `<div class="text-left">
                <p class="mb-3 text-red-600 font-semibold">Perhatian: Tindakan ini tidak dapat dibatalkan!</p>
                <p>Apakah Anda yakin ingin menghapus data peminjaman atas nama:</p>
                <div class="bg-red-50 p-3 rounded mt-2">
                    <p class="text-lg font-bold text-center">${namaPeminjam}</p>
                </div>
                <p class="text-sm text-gray-500 mt-3">Semua data terkait peminjaman ini akan dihapus permanen.</p>
            </div>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus Data',
            cancelButtonText: 'Batalkan',
            reverseButtons: true,
            width: '500px'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // Fungsi untuk menampilkan detail peminjaman
    function showDetailPeminjaman(id, nama, nim, barang, kondisi, status, tanggalPinjam, tanggalKembali, catatan = '') {
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

        Swal.fire({
            title: 'Detail Peminjaman',
            html: `<div class="text-left space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <h3 class="font-semibold text-gray-700">Data Peminjam</h3>
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-sm"><span class="font-medium">Nama:</span> ${nama}</p>
                            <p class="text-sm"><span class="font-medium">NIM:</span> ${nim}</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h3 class="font-semibold text-gray-700">Informasi Barang</h3>
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-sm"><span class="font-medium">Barang:</span> ${barang}</p>
                            <p class="text-sm"><span class="font-medium">Kondisi Awal:</span> ${kondisi}</p>
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
                        <div class="bg-green-50 p-3 rounded">
                            <p class="text-sm">${tanggalKembali ? formatTanggal(tanggalKembali) : 'Belum dikembalikan'}</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Status</h3>
                    <span class="px-3 py-1 rounded-full text-sm font-medium ${statusColor}">
                        ${status}
                    </span>
                </div>

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

    // Fungsi untuk menampilkan form pengembalian dengan kondisi
    function showFormPengembalian(event, id, nama, barang) {
        event.preventDefault();

        Swal.fire({
            title: 'Konfirmasi Pengembalian Barang',
            html: `<div class="text-left">
                <p class="mb-4">Apakah Anda yakin ingin mengembalikan barang ini?</p>
                <div class="bg-blue-50 p-3 rounded">
                    <p class="text-sm"><span class="font-semibold">Peminjam:</span> ${nama}</p>
                    <p class="text-sm"><span class="font-semibold">Barang:</span> ${barang}</p>
                </div>
            </div>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Kembalikan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            width: '500px'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim data ke server dengan kondisi default
                fetch(`/peminjaman/${id}/kembali`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        kondisi: 'Baik',
                        catatan: ''
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menyimpan data'
                    });
                });
            }
        });
    }
</script>
