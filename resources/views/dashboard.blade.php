<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-800 dark:text-white leading-tight">
                {{ __('Ringkasan Lab') }}
            </h2>

            <a href="{{ route('peminjaman.create') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Input Peminjaman Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Unit Alat</p>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-2">{{ number_format($totalUnits) }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs">
                        <span class="text-green-500 font-medium flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                            +12 Unit
                        </span>
                        <span class="text-slate-400 ml-2">bulan ini</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Sedang Dipinjam</p>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-2">{{ $currentlyBorrowed }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs">
                        <span class="text-orange-600 font-medium bg-orange-50 px-2 py-0.5 rounded-full border border-orange-100">
                            {{ $terlambat }} Terlambat
                        </span>
                        <span class="text-slate-400 ml-2">perlu ditindak</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Mahasiswa Aktif</p>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-2">{{ $mahasiswaCount }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs">
                        <span class="text-green-500 font-medium flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                            5.4%
                        </span>
                        <span class="text-slate-400 ml-2">vs semester lalu</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Kondisi Baik</p>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-2">{{ $kondisiBaikPct }}%</h3>
                        </div>
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                    </div>
                        <div class="mt-4 w-full bg-gray-100 dark:bg-gray-800 rounded-full h-1.5">
                        <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $kondisiBaikPct }}%"></div>
                        </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-slate-800 dark:text-white">Statistik Peminjaman</h3>
                        <div class="flex gap-2">
                            <button class="px-3 py-1 text-xs font-medium bg-blue-50 text-blue-700 rounded-md">Mingguan</button>
                            <button class="px-3 py-1 text-xs font-medium text-slate-500 hover:text-blue-700 rounded-md">Bulanan</button>
                        </div>
                    </div>

                    <div class="h-64 flex items-end justify-between gap-2 px-2">
                        @php
                            $chartDays = collect($days);
                            $max = $chartDays->max('count') ?: 1;
                        @endphp
                        @foreach ($chartDays as $d)
                            @php
                                $h = $max > 0 ? max(6, (int) round(($d['count'] / $max) * 90)) : 6;
                            @endphp
                            <div class="w-full bg-blue-100 dark:bg-blue-900 rounded-t-md hover:bg-blue-200 transition-all relative group"
                                 style="height: {{ $h }}%">
                                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition">{{ $d['count'] }} Pinjam</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between mt-4 text-xs text-slate-400 border-t border-gray-100 pt-4">
                        @foreach ($chartDays as $d)
                            <span>{{ $d['label'] }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-6">Aksi Cepat</h3>
                    <div class="space-y-3">

                        <a href="{{ route('reports.export') }}" class="w-full flex items-center justify-between p-4 bg-slate-50 dark:bg-gray-800 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-200 border border-transparent transition-all group">
                            <div class="flex items-center gap-3">
                                <span class="bg-white dark:bg-gray-700 p-2 rounded-md text-blue-600 shadow-sm group-hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                </span>
                                <div class="text-left">
                                    <p class="font-medium text-slate-700 dark:text-slate-200 group-hover:text-blue-800">Unduh Laporan</p>
                                    <p class="text-xs text-slate-400">Format CSV (unduh)</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>

                        <a href="{{ route('barang.index', ['filter' => 'rusak']) }}" class="w-full flex items-center justify-between p-4 bg-slate-50 dark:bg-gray-800 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-200 border border-transparent transition-all group">
                            <div class="flex items-center gap-3">
                                <span class="bg-white dark:bg-gray-700 p-2 rounded-md text-blue-600 shadow-sm group-hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                </span>
                                <div class="text-left">
                                    <p class="font-medium text-slate-700 dark:text-slate-200 group-hover:text-blue-800">Cek Barang Rusak</p>
                                    <p class="text-xs text-slate-400">Lihat daftar barang rusak / input baru</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <h4 class="text-sm font-medium text-slate-500 mb-4">Kapasitas Penyimpanan</h4>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-slate-600 dark:text-slate-400">Lemari Bahan Kimia</span>
                                    <span class="text-blue-700 font-medium">85% Penuh</span>
                                </div>
                                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: 85%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-slate-600 dark:text-slate-400">Rak Alat Elektronik</span>
                                    <span class="text-purple-600 font-medium">40% Terisi</span>
                                </div>
                                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                                    <div class="bg-purple-500 h-1.5 rounded-full" style="width: 40%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-white">Peminjaman Terakhir</h3>
                    <a href="{{ route('peminjaman.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                        <thead class="bg-slate-50 dark:bg-gray-800 text-slate-500 uppercase font-medium text-xs">
                            <tr>
                                <th class="px-6 py-4">Nama Mahasiswa</th>
                                <th class="px-6 py-4">Alat Dipinjam</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Waktu Pinjam</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($recent as $r)
                                <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-800 dark:text-white">{{ $r->mahasiswa->nama }} ({{ $r->mahasiswa->nim ?? '' }})</td>
                                    <td class="px-6 py-4">{{ $r->barang->nama_barang }}</td>
                                    <td class="px-6 py-4">
                                        @if($r->status === 'Dipinjam')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                                Sedang Dipinjam
                                            </span>
                                        @elseif($r->status === 'Kembali')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                Dikembalikan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                {{ $r->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $r->tgl_pinjam ? $r->tgl_pinjam->diffForHumans() : '-' }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-slate-400 hover:text-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">Belum ada peminjaman terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
