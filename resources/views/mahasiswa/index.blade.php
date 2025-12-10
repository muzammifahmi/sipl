<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-800 dark:text-white leading-tight">
                {{ __('Data Master Mahasiswa (User)') }}
            </h2>

            <form action="{{ route('mahasiswa.preprocess') }}" method="POST">
                @csrf

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v4" />
                        <path d="m16.2 7.8 2.9-2.9" />
                        <path d="M18 12h4" />
                        <path d="m16.2 16.2 2.9 2.9" />
                        <path d="M12 18v4" />
                        <path d="m4.9 19.1 2.9-2.9" />
                        <path d="M2 12h4" />
                        <path d="m4.9 4.9 2.9 2.9" />
                    </svg>
                    Jalankan Preprocessing
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                            <thead
                                class="bg-slate-50 dark:bg-gray-700 text-slate-500 dark:text-slate-300 uppercase font-bold text-xs">
                                <tr>
                                    <th class="px-6 py-4 rounded-tl-lg">Identitas (NIM)</th>
                                    <th class="px-6 py-4">Nama & Email</th>
                                    <th class="px-6 py-4">Angkatan</th>
                                    <th
                                        class="px-6 py-4 bg-blue-50 dark:bg-blue-900/20 border-l border-blue-100 dark:border-blue-800">
                                        Data Jurusan (Raw vs Clean)
                                    </th>
                                    <th class="px-6 py-4 rounded-tr-lg text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($mahasiswas as $mhs)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-700/50 transition duration-150">
                                        <td
                                            class="px-6 py-4 font-mono font-semibold text-slate-700 dark:text-slate-300">
                                            {{ $mhs->nim }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="font-bold text-slate-900 dark:text-white text-base">
                                                {{ $mhs->nama }}
                                            </div>
                                            <div class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                                </svg>
                                                {{ $mhs->email }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $mhs->angkatan }}
                                            </span>
                                        </td>

                                        <td
                                            class="px-6 py-4 bg-blue-50/30 dark:bg-blue-900/10 border-l border-blue-100 dark:border-blue-800">
                                            <div class="flex flex-col gap-2">
                                                <div class="text-xs">
                                                    <span class="text-slate-400 uppercase text-[10px] font-bold">Input
                                                        User (Raw):</span>
                                                    <div
                                                        class="italic text-red-500 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded border border-red-100 dark:border-red-800 mt-1">
                                                        {{ $mhs->jurusan_raw }}
                                                    </div>
                                                </div>

                                                <div class="text-xs">
                                                    <span class="text-slate-400 uppercase text-[10px] font-bold">Hasil
                                                        Sistem (Clean):</span>
                                                    @if ($mhs->jurusan_clean)
                                                        <div
                                                            class="font-bold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded border border-green-100 dark:border-green-800 mt-1 flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <polyline points="20 6 9 17 4 12" />
                                                            </svg>
                                                            {{ $mhs->jurusan_clean }}
                                                        </div>
                                                    @else
                                                        <div class="mt-1 text-slate-400 italic flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-3 h-3 animate-spin" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                                                            </svg>
                                                            Belum dipreprocess
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="#"
                                                    class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-full transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus data mahasiswa ini? Data peminjaman terkait juga akan terhapus.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-full transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M3 6h18" />
                                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-12 w-12 text-slate-300 mb-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <p class="text-base font-medium">Belum ada data mahasiswa.</p>
                                                <p class="text-sm mt-1">Lakukan input peminjaman, data mahasiswa akan
                                                    otomatis tersimpan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $mahasiswas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
