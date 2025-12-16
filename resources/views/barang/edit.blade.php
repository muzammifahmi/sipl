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

                    <form id="editBarangForm" action="{{ route('barang.update', $barang->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <button type="button" onclick="konfirmasiPerbarui()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Perbarui Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Fungsi untuk konfirmasi sebelum submit
function konfirmasiPerbarui() {
    // Ambil nilai dari form
    const kodeBarang = document.getElementById('kode_barang').value;
    const namaBarang = document.getElementById('nama_barang').value;
    const kategori = document.getElementById('kategori').value;
    const stokTotal = document.getElementById('stok_total').value;
    const stokTersedia = {{ $barang->stok_tersedia }};

    // Hitung selisih stok
    const stokBaru = parseInt(stokTotal);
    const stokLama = {{ $barang->stok_total }};
    const selisih = stokBaru - stokLama;

    let stokPesan = '';
    if (selisih > 0) {
        stokPesan = `<div class="bg-green-50 border-l-4 border-green-500 p-3 my-2 rounded">
            <p class="text-sm text-green-700">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <strong>Stok akan ditambah:</strong> ${selisih} unit
            </p>
        </div>`;
    } else if (selisih < 0) {
        stokPesan = `<div class="bg-yellow-50 border-l-4 border-yellow-500 p-3 my-2 rounded">
            <p class="text-sm text-yellow-700">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.408 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <strong>Stok akan dikurangi:</strong> ${Math.abs(selisih)} unit
            </p>
        </div>`;
    } else {
        stokPesan = `<div class="bg-blue-50 border-l-4 border-blue-500 p-3 my-2 rounded">
            <p class="text-sm text-blue-700">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <strong>Tidak ada perubahan stok</strong>
            </p>
        </div>`;
    }

    // Cek jika stok total lebih kecil dari stok tersedia (peminjaman aktif)
    if (stokBaru < stokTersedia) {
        Swal.fire({
            icon: 'error',
            title: 'Stok Tidak Valid',
            html: `<div class="text-left">
                <p class="mb-3">Stok total tidak boleh lebih kecil dari stok tersedia!</p>
                <div class="bg-red-50 p-3 rounded">
                    <p class="text-sm">Stok Total Baru: <strong>${stokBaru} unit</strong></p>
                    <p class="text-sm">Stok Tersedia Saat Ini: <strong>${stokTersedia} unit</strong></p>
                    <p class="text-sm mt-2 text-red-600">Ada ${stokTersedia - stokBaru} unit yang masih dipinjam.</p>
                </div>
                <p class="text-xs text-gray-500 mt-3">Harap batalkan peminjaman terlebih dahulu atau ubah stok total menjadi minimal ${stokTersedia} unit.</p>
            </div>`,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Mengerti'
        });
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Perubahan Data',
        html: `<div class="text-left">
            <p class="mb-3">Anda akan memperbarui data alat:</p>

            <div class="bg-gray-50 p-3 rounded mb-3">
                <p class="text-sm"><span class="font-semibold">Nama Alat:</span> ${namaBarang}</p>
                <p class="text-sm"><span class="font-semibold">Kode:</span> ${kodeBarang}</p>
                <p class="text-sm"><span class="font-semibold">Kategori:</span> ${kategori}</p>
            </div>

            ${stokPesan}

            <div class="bg-blue-50 p-3 rounded mt-3">
                <p class="text-sm">
                    <svg class="w-4 h-4 inline mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span class="font-semibold">Perhatian:</span> Pastikan data sudah benar.
                </p>
            </div>
        </div>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Perbarui Data',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        width: '500px',
        didOpen: () => {
            // Fokus ke tombol cancel untuk keamanan
            const cancelButton = Swal.getCancelButton();
            cancelButton.focus();
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading
            Swal.fire({
                title: 'Memproses...',
                html: 'Menyimpan perubahan data alat',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            document.getElementById('editBarangForm').submit();
        }
    });
}

// Validasi sebelum submit form
document.getElementById('editBarangForm').addEventListener('submit', function(e) {
    // Validasi client-side sederhana
    const kodeBarang = document.getElementById('kode_barang').value.trim();
    const namaBarang = document.getElementById('nama_barang').value.trim();
    const stokTotal = document.getElementById('stok_total').value;

    if (!kodeBarang || !namaBarang || !stokTotal) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Data Belum Lengkap',
            text: 'Harap isi semua field yang wajib diisi!',
            confirmButtonColor: '#ef4444'
        });
        return false;
    }

    if (stokTotal < 0) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Stok Tidak Valid',
            text: 'Stok total tidak boleh negatif!',
            confirmButtonColor: '#ef4444'
        });
        return false;
    }
});

// Tampilkan pesan sukses jika ada di session
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

// Alert untuk perubahan stok yang signifikan
const stokTotalInput = document.getElementById('stok_total');
const stokTersedia = {{ $barang->stok_tersedia }};

stokTotalInput.addEventListener('change', function() {
    const stokBaru = parseInt(this.value);
    const stokLama = {{ $barang->stok_total }};
    const selisih = stokBaru - stokLama;

    // Jika pengurangan stok lebih dari 50%
    if (selisih < 0 && Math.abs(selisih) > (stokLama * 0.5)) {
        Swal.fire({
            icon: 'warning',
            title: 'Pengurangan Stok Besar',
            html: `<div class="text-left">
                <p>Anda akan mengurangi stok sebesar <strong>${Math.abs(selisih)} unit</strong> (${Math.round((Math.abs(selisih)/stokLama)*100)}% dari stok lama).</p>
                <div class="bg-yellow-50 p-2 rounded mt-2">
                    <p class="text-xs">Pastikan ini benar-benar diperlukan!</p>
                </div>
            </div>`,
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#f59e0b',
            width: '400px'
        });
    }
});
</script>
