<tr class="hover:bg-slate-50 dark:hover:bg-gray-700/50 transition duration-150">

    {{-- Kolom tanggal pinjam --}}
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-slate-800 dark:text-white font-medium">
            {{ \Carbon\Carbon::parse($pinjam->tgl_pinjam)->format('d M Y') }}
        </div>
        <div class="text-xs text-slate-500">
            Rencana: {{ \Carbon\Carbon::parse($pinjam->tgl_kembali_rencana)->format('d M Y') }}
        </div>
    </td>

    {{-- Data Mahasiswa --}}
    <td class="px-6 py-4">
        <div class="font-bold text-slate-800 dark:text-white">{{ $pinjam->mahasiswa->nama }}</div>
        <div class="text-xs text-blue-600 dark:text-blue-400 font-mono">{{ $pinjam->mahasiswa->nim }}</div>
        <div class="text-[10px] text-slate-400 truncate max-w-[150px]"
            title="{{ $pinjam->mahasiswa->jurusan_raw }}">
            {{ $pinjam->mahasiswa->jurusan_raw }}
        </div>
    </td>

    {{-- Barang Dipinjam --}}
    <td class="px-6 py-4">
        <div class="font-medium text-slate-800 dark:text-white">{{ $pinjam->barang->nama_barang }}</div>
        <div class="text-xs text-slate-500">{{ $pinjam->barang->kode_barang }}</div>
    </td>

    {{-- Kondisi Barang --}}
    <td class="px-6 py-4">
        <span class="italic bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded text-xs border border-slate-200 dark:border-gray-600">
            {{ $pinjam->kondisi_pinjam_raw }}
        </span>
    </td>

    {{-- Status Peminjaman --}}
    <td class="px-6 py-4 text-center">
        @if ($pinjam->status == 'Dipinjam')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                bg-yellow-100 text-yellow-800 border border-yellow-200">
                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5 animate-pulse"></span>
                Sedang Dipinjam
            </span>
        @elseif($pinjam->status == 'Kembali')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                bg-green-100 text-green-800 border border-green-200">
                Sudah Kembali
            </span>
            <div class="text-[10px] text-slate-400 mt-1">
                {{ \Carbon\Carbon::parse($pinjam->tgl_kembali_realisasi)->format('d/m/y H:i') }}
            </div>
        @else
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                bg-red-100 text-red-800 border border-red-200">
                Terlambat
            </span>
        @endif
    </td>

    {{-- Tombol Aksi --}}
    <td class="px-6 py-4 text-right space-x-2">

        {{-- Button Konfirmasi Pengembalian --}}
        @if ($pinjam->status == 'Dipinjam')
            <form action="{{ route('peminjaman.update', $pinjam->id) }}"
                method="POST"
                class="inline-block"
                onsubmit="return confirm('Konfirmasi pengembalian barang ini? Stok akan otomatis bertambah.');">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="Kembali">

                <button type="submit"
                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 rounded-md text-white text-xs font-semibold hover:bg-blue-700 active:bg-blue-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Kembalikan
                </button>
            </form>
        @endif

        {{-- Tombol Hapus --}}
        @if ($pinjam->status == 'Kembali')
        <form action="{{ route('peminjaman.destroy', $pinjam->id) }}"
            method="POST"
            class="inline-block"
            onsubmit="return confirm('Yakin menghapus data ini? Data tidak bisa dikembalikan.');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="inline-flex items-center px-3 py-1.5 bg-red-600 rounded-md text-white text-xs font-semibold hover:bg-red-700 active:bg-red-900 transition">
                🗑 Hapus
            </button>
        </form>
        @endif


    </td>
</tr>
