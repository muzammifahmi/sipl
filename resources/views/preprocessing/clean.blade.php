<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Data Bersih (Clean Data)') }}
            </h2>
            <a href="{{ route('reports.export') }}">
                <button class="flex items-center text-sm text-gray-600 hover:text-gray-900 font-medium transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Export CSV
                </button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Statistik Pembersihan (Card Summary) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="text-xs text-gray-500 uppercase font-bold">Total Data</div>
                    <div class="text-2xl font-bold text-gray-800 dark:text-white mt-2">{{ $cleanData->count() }}</div>
                    <div class="text-xs text-green-500 mt-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Siap diolah
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="text-xs text-gray-500 uppercase font-bold">Missing Values Diisi</div>
                    <div class="text-2xl font-bold text-blue-600 mt-2">0</div>
                    <div class="text-xs text-gray-400 mt-1">Menggunakan metode Mean/Modus</div>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="text-xs text-gray-500 uppercase font-bold">Outliers Dihapus</div>
                    <div class="text-2xl font-bold text-red-500 mt-2">0</div>
                    <div class="text-xs text-gray-400 mt-1">Data menyimpang jauh</div>
                </div>
            </div>

            {{-- Tabel Data Bersih --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-green-500">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Preview Hasil Preprocessing</h3>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded">STATUS:
                            CLEAN</span>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                            <thead class="bg-gray-50 dark:bg-gray-900 text-gray-500 uppercase font-bold text-xs">
                                <tr>
                                    <th class="px-4 py-3 border-b">No</th>
                                    <th class="px-4 py-3 border-b">Nama Lengkap</th>
                                    <th class="px-4 py-3 border-b">NIM</th>
                                    <th class="px-4 py-3 border-b">Jurusan (Clean)</th>
                                    <th class="px-4 py-3 border-b">Angkatan</th>
                                    <th class="px-4 py-3 border-b">Email</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                                @foreach ($cleanData as $index => $row)
                                    <tr
                                        class="transition duration-150 hover:bg-gray-100 dark:hover:bg-gray-700 hover:shadow-sm">
                                        <td class="px-4 py-3 text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $row->nama }}</td>
                                        {{-- Jurusan hasil preprocessing --}}
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $row->nim }}</td>
                                        <td class="px-4 py-3 text-blue-600 font-medium">{{ $row->jurusan_clean }}</td>
                                        <td class="px-4 py-3">{{ $row->angkatan }}</td>
                                        <td class="px-4 py-3">{{ $row->email ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Next Step Button --}}
                    <div class="mt-6 flex justify-end">
                        <a href="#"
                            class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-md font-bold text-sm shadow-lg hover:bg-green-700 transition transform hover:-translate-y-0.5">
                            Lanjut ke Proses Algoritma
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
