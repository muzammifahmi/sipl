<tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-slate-800 dark:text-white font-medium">
            {{ \Carbon\Carbon::parse($pinjam->created_at)->format('d M Y') }}
        </div>
        <div class="text-xs text-slate-500">
            {{ \Carbon\Carbon::parse($pinjam->created_at)->format('H:i') }}
        </div>
    </td>

    <td class="px-6 py-4">
        <div class="font-medium text-slate-800 dark:text-white">
            {{ $pinjam->mahasiswa->nama }}
        </div>
        <div class="text-sm text-slate-500">
            {{ $pinjam->mahasiswa->nim }}
        </div>
        <div class="text-xs text-slate-400 mt-1">
            {{ $pinjam->mahasiswa->jurusan_raw ?? 'N/A' }}
        </div>
    </td>

    <td class="px-6 py-4">
        <div class="font-medium text-slate-800 dark:text-white">
            {{ $pinjam->barang->nama_barang }}
        </div>
        <div class="text-xs text-slate-500">
            Kode: {{ $pinjam->barang->kode_barang }}
        </div>
    </td>

    <td class="px-6 py-4">
        <span class="px-2 py-1 text-xs rounded-full
            {{ ($pinjam->kondisi_pinjam_clean ?? $pinjam->kondisi_pinjam_raw) == 'Baik' ? 'bg-green-100 text-green-800' :
               (($pinjam->kondisi_pinjam_clean ?? $pinjam->kondisi_pinjam_raw) == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' :
               'bg-red-100 text-red-800') }}">
            {{ $pinjam->kondisi_pinjam_clean ?? $pinjam->kondisi_pinjam_raw ?? 'N/A' }}
        </span>
    </td>

    <td class="px-6 py-4 text-center">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
            {{ $pinjam->status == 'Dipinjam' ? 'bg-yellow-100 text-yellow-800' :
               ($pinjam->status == 'Kembali' ? 'bg-green-100 text-green-800' :
               'bg-red-100 text-red-800') }}">
            @if($pinjam->status == 'Dipinjam')
                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
            @elseif($pinjam->status == 'Kembali')
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
            @else
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            @endif
            {{ $pinjam->status }}
        </span>
    </td>

    <td class="px-6 py-4 text-right">
        <div class="flex items-center justify-end space-x-2">
            <!-- Tombol Detail -->
            <button onclick="showDetailPeminjaman(
                '{{ $pinjam->id }}',
                '{{ $pinjam->mahasiswa->nama }}',
                '{{ $pinjam->mahasiswa->nim }}',
                '{{ $pinjam->barang->nama_barang }}',
                '{{ $pinjam->kondisi_pinjam_clean ?? $pinjam->kondisi_pinjam_raw }}',
                '{{ $pinjam->status }}',
                '{{ $pinjam->created_at }}',
                '{{ $pinjam->tgl_kembali_realisasi ?? $pinjam->tgl_kembali_rencana }}',
                '{{ $pinjam->keperluan ?? '' }}'
            )" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Detail
            </button>

            @if($pinjam->status == 'Dipinjam')
                <!-- Tombol Kembali -->
                <button onclick="showFormPengembalian(event, '{{ $pinjam->id }}', '{{ $pinjam->mahasiswa->nama }}', '{{ $pinjam->barang->nama_barang }}')"
                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-green-600 hover:text-green-800 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Kembali
                </button>
            @endif

            <!-- Tombol Hapus -->
            <form action="{{ route('peminjaman.destroy', $pinjam) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="button" onclick="konfirmasiHapus(event, '{{ $pinjam->mahasiswa->nama }}')"
                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </td>
</tr>
