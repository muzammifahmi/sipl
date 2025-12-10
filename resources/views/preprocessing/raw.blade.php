<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dataset Mentah (Raw Data)') }}
            </h2>
            {{-- Tombol Import --}}
            <button class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                Import Excel / CSV
            </button>
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
                                Data ini belum lengkap. Terdapat <span class="font-bold">{{ $nullCount }} baris</span> dengan NIM kosong (ditandai merah).
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
                                Semua data terlihat lengkap — tidak ada NIM kosong.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Flash Success --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 rounded shadow-sm">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    @endif

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
                    </div>

                    {{-- Action Footer --}}
                    <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                        <form method="POST" action="{{ route('mahasiswa.preprocess') }}" onsubmit="return confirm('Jalankan preprocessing untuk semua data mahasiswa?');">
                            @csrf
                            <button type="submit" class="flex items-center px-6 py-3 bg-slate-800 dark:bg-slate-200 text-white dark:text-slate-800 rounded-md font-bold text-sm shadow-lg hover:bg-slate-700 transition">
                                <i class="mr-2 not-italic">✨</i> Jalankan Preprocessing
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
