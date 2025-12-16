<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-800 dark:text-white leading-tight">
                {{ __('Data Master Alat (Inventaris)') }}
            </h2>

            <a href="{{ route('barang.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Alat Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Flash Messages sudah dihandle oleh SweetAlert di script -->

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Filter dan Search (opsional) -->
                    <div class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
                        <div class="text-sm text-slate-500">
                            Total <span class="font-semibold">{{ $barangs->total() }}</span> alat dalam inventaris
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Cari alat..."
                                   class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg text-sm w-full md:w-64 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   id="searchBarang">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                            <thead class="bg-slate-50 dark:bg-gray-700 text-slate-500 dark:text-slate-300 uppercase font-bold text-xs">
                                <tr>
                                    <th class="px-6 py-4 rounded-tl-lg">Kode Barang</th>
                                    <th class="px-6 py-4">Nama Alat</th>
                                    <th class="px-6 py-4">Kategori</th>
                                    <th class="px-6 py-4 text-center">Stok (Tersedia / Total)</th>
                                    <th class="px-6 py-4">Lokasi Rak</th>
                                    <th class="px-6 py-4 rounded-tr-lg text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700" id="tableBody">
                                @forelse ($barangs as $barang)
                                <tr class="hover:bg-slate-50 dark:hover:bg-gray-700/50 transition duration-150" data-kode="{{ strtolower($barang->kode_barang) }}" data-nama="{{ strtolower($barang->nama_barang) }}">
                                    <td class="px-6 py-4 font-mono text-xs font-semibold text-blue-600 dark:text-blue-400">
                                        {{ $barang->kode_barang }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900 dark:text-white text-base">
                                            {{ $barang->nama_barang }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-600 dark:text-slate-200 border border-slate-200 dark:border-slate-500">
                                            {{ $barang->kategori }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <span class="font-bold text-lg {{ $barang->stok_tersedia > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                                {{ $barang->stok_tersedia }}
                                            </span>
                                            <span class="text-slate-400 text-xs">/</span>
                                            <span class="text-slate-500 dark:text-slate-400 text-sm">
                                                {{ $barang->stok_total }}
                                            </span>
                                        </div>
                                        @if($barang->stok_tersedia == 0)
                                            <span class="text-[10px] text-red-500 font-semibold uppercase tracking-wide">Habis Dipinjam</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1 text-slate-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                            {{ $barang->lokasi_rak ?: 'Belum diatur' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Tombol Detail -->
                                            <button onclick="showDetailBarang({{ json_encode($barang) }})"
                                                    class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-full transition"
                                                    title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                </svg>
                                            </button>

                                            <!-- Tombol Edit -->
                                            <a href="{{ route('barang.edit', $barang->id) }}"
                                               class="p-2 text-slate-400 hover:text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-full transition"
                                               title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <button onclick="konfirmasiHapusBarang(event, {{ $barang->id }}, '{{ addslashes($barang->nama_barang) }}', '{{ addslashes($barang->kode_barang) }}', {{ $barang->stok_tersedia }}, {{ $barang->stok_total }})"
                                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-full transition"
                                                    title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                    <line x1="10" y1="11" x2="10" y2="17"/>
                                                    <line x1="14" y1="11" x2="14" y2="17"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="text-base font-medium">Belum ada data alat.</p>
                                            <p class="text-sm mt-1">Silakan tambahkan inventaris baru.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $barangs->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Fungsi untuk menampilkan detail barang
function showDetailBarang(barang) {
    // Hitung persentase stok tersedia
    const persentaseTersedia = barang.stok_total > 0 ?
        Math.round((barang.stok_tersedia / barang.stok_total) * 100) : 0;

    // Warna berdasarkan persentase
    let warnaPersentase = 'text-red-600';
    let ikonStok = '<svg class="w-5 h-5 inline mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';

    if (persentaseTersedia >= 50) {
        warnaPersentase = 'text-green-600';
        ikonStok = '<svg class="w-5 h-5 inline mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
    } else if (persentaseTersedia > 0) {
        warnaPersentase = 'text-yellow-600';
        ikonStok = '<svg class="w-5 h-5 inline mr-1 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.408 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>';
    }

    Swal.fire({
        title: 'Detail Alat Inventaris',
        html: `<div class="text-left space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Informasi Utama</h3>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <p class="text-sm"><span class="font-medium">Kode Barang:</span> <span class="font-mono text-blue-600">${barang.kode_barang}</span></p>
                        <p class="text-sm"><span class="font-medium">Nama Alat:</span> <strong>${barang.nama_barang}</strong></p>
                        <p class="text-sm"><span class="font-medium">Kategori:</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                ${barang.kategori}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Status Stok</h3>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium">Stok Tersedia:</span>
                            <span class="font-bold text-lg ${barang.stok_tersedia > 0 ? 'text-green-600' : 'text-red-600'}">
                                ${barang.stok_tersedia} unit
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium">Stok Total:</span>
                            <span class="font-semibold">${barang.stok_total} unit</span>
                        </div>
                        <div class="mt-2">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-${barang.stok_tersedia > 0 ? 'green' : 'red'}-600 h-2 rounded-full" style="width: ${persentaseTersedia}%"></div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1 text-right">
                                ${persentaseTersedia}% tersedia
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Lokasi & Info</h3>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <p class="text-sm"><span class="font-medium">Lokasi Rak:</span> ${barang.lokasi_rak || 'Belum diatur'}</p>
                        <p class="text-sm"><span class="font-medium">Status:</span>
                            ${barang.stok_tersedia > 0 ?
                                '<span class="text-green-600 font-semibold">✓ Tersedia</span>' :
                                '<span class="text-red-600 font-semibold">✗ Habis Dipinjam</span>'
                            }
                        </p>
                    </div>
                </div>

                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-700">Ringkasan</h3>
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded">
                        <p class="text-sm">${ikonStok} <span class="${warnaPersentase} font-medium">${persentaseTersedia}% stok tersedia</span></p>
                        <p class="text-sm mt-1">${barang.stok_total - barang.stok_tersedia} unit sedang dipinjam</p>
                        <p class="text-xs text-gray-500 mt-2">Terakhir update: ${new Date(barang.updated_at).toLocaleDateString('id-ID')}</p>
                    </div>
                </div>
            </div>

            <div class="text-xs text-gray-500 pt-4 border-t">
                <p>ID: ${barang.id} • Dibuat: ${new Date(barang.created_at).toLocaleDateString('id-ID')}</p>
            </div>
        </div>`,
        width: '600px',
        showConfirmButton: true,
        confirmButtonText: 'Tutup',
        confirmButtonColor: '#3b82f6',
        showCloseButton: true,
        showDenyButton: true,
        denyButtonText: 'Edit Data',
        denyButtonColor: '#f59e0b'
    }).then((result) => {
        if (result.isDenied) {
            window.location.href = `/barang/${barang.id}/edit`;
        }
    });
}

// Fungsi untuk konfirmasi hapus barang
function konfirmasiHapusBarang(event, id, namaBarang, kodeBarang, stokTersedia, stokTotal) {
    event.preventDefault();

    // Cek jika ada stok yang masih dipinjam
    const sedangDipinjam = stokTotal - stokTersedia;

    let warningMessage = '';
    if (sedangDipinjam > 0) {
        warningMessage = `<div class="bg-red-50 border-l-4 border-red-500 p-3 my-3 rounded">
            <p class="text-sm text-red-700">
                <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.408 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <strong>PERINGATAN:</strong> Ada <strong>${sedangDipinjam} unit</strong> yang masih dipinjam!
            </p>
            <p class="text-xs text-red-600 mt-1">Penghapusan akan membatalkan semua peminjaman aktif.</p>
        </div>`;
    }

    Swal.fire({
        title: 'Konfirmasi Penghapusan Alat',
        html: `<div class="text-left">
            <p class="mb-3 text-red-600 font-semibold">PERHATIAN: Tindakan ini tidak dapat dibatalkan!</p>

            <div class="bg-red-50 p-3 rounded mb-3">
                <p class="text-lg font-bold text-center text-red-700">${namaBarang}</p>
                <p class="text-sm text-center text-red-600">Kode: ${kodeBarang}</p>
            </div>

            ${warningMessage}

            <div class="bg-yellow-50 p-3 rounded">
                <p class="text-sm"><strong>Dampak Penghapusan:</strong></p>
                <ul class="text-xs text-gray-700 list-disc pl-4 mt-1 space-y-1">
                    <li>Data alat akan dihapus permanen dari database</li>
                    <li>Riwayat peminjaman terkait alat ini akan tetap ada</li>
                    <li>${sedangDipinjam > 0 ? `${sedangDipinjam} peminjaman aktif akan dibatalkan` : 'Tidak ada peminjaman aktif'}</li>
                    <li>Stok ${stokTotal} unit akan dihapus dari inventaris</li>
                </ul>
            </div>

            <div class="mt-4 p-3 bg-gray-50 rounded">
                <p class="text-sm font-medium">Masukkan nama alat untuk konfirmasi:</p>
                <input type="text" id="confirmDeleteInput" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-md" placeholder="Ketik: ${namaBarang}">
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
        preConfirm: () => {
            const inputValue = document.getElementById('confirmDeleteInput').value;
            if (inputValue !== namaBarang) {
                Swal.showValidationMessage(`Harap ketik "${namaBarang}" untuk konfirmasi`);
                return false;
            }
            return true;
        },
        didOpen: () => {
            document.getElementById('confirmDeleteInput').focus();
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Menghapus data alat dari inventaris',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim request delete
            fetch(`/barang/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Gagal menghapus data');
            })
            .then(data => {
                // Tutup loading
                Swal.close();

                // Tampilkan pesan sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message || 'Alat berhasil dihapus',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    // Reload halaman
                    window.location.reload();
                });
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

// Fungsi untuk search real-time
document.getElementById('searchBarang')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#tableBody tr');

    rows.forEach(row => {
        const kode = row.getAttribute('data-kode') || '';
        const nama = row.getAttribute('data-nama') || '';

        if (kode.includes(searchTerm) || nama.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

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

// Konfirmasi sebelum meninggalkan halaman jika ada perubahan yang belum disimpan
window.addEventListener('beforeunload', function (e) {
    // Hanya aktif jika ada form yang sedang diedit
    const formElements = document.querySelectorAll('form');
    let hasUnsavedChanges = false;

    formElements.forEach(form => {
        if (form.classList.contains('unsaved-changes')) {
            hasUnsavedChanges = true;
        }
    });

    if (hasUnsavedChanges) {
        e.preventDefault();
        e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
    }
});
</script>
