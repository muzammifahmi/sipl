<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SIPL - Sistem Inventaris Lab {{ config('app.name', 'Kampus') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/favicon.svg') }}" type="image/svg+xml">
  </head>
  <body class="bg-white dark:bg-slate-900 text-slate-900 dark:text-gray-100 font-sans antialiased">

    <header class="sticky top-0 z-50 bg-white/95 dark:bg-slate-900/95 backdrop-blur shadow-sm border-b border-gray-100 dark:border-gray-800">
      <div class="container mx-auto px-4 md:px-8 lg:px-16 xl:px-24 flex items-center justify-between h-16">
        <a href="/" class="flex items-center gap-2 font-bold text-xl text-blue-700 dark:text-blue-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.31"/><path d="M14 2v7.31"/><path d="M8.5 2h7"/><path d="M14 9.3a6.5 6.5 0 1 1-4 0"/><path d="M5.52 16h12.96"/></svg>
          <span>SIPL Kampus</span>
        </a>

        <nav class="hidden lg:flex items-center gap-6 text-sm font-medium text-slate-600 dark:text-slate-300">
          <a href="#fitur" class="hover:text-blue-600 transition">Fitur Sistem</a>
          <a href="#statistik" class="hover:text-blue-600 transition">Statistik Data</a>
          <a href="#tim" class="hover:text-blue-600 transition">Tim Pengembang</a>
        </nav>

        <div class="hidden lg:flex items-center gap-3">
          <a href="/login" class="px-5 py-2 text-sm font-medium text-slate-700 hover:text-blue-600 transition">Log in Admin</a>
          <a href="/input-data" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition transform hover:-translate-y-0.5">Input Peminjaman</a>
        </div>

        <button id="menu-button" class="lg:hidden p-2 text-slate-600" aria-label="open menu">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="18" x2="20" y2="18"></line></svg>
        </button>
      </div>
    </header>

    <div id="nav-links" class="fixed inset-0 z-50 bg-slate-900/90 backdrop-blur-sm flex items-center justify-center lg:hidden -translate-x-full transition-transform duration-300">
      <div class="flex flex-col items-center gap-8 text-xl font-semibold text-white">
        <a href="#fitur" onclick="document.getElementById('nav-links').classList.add('-translate-x-full')">Fitur Sistem</a>
        <a href="#statistik" onclick="document.getElementById('nav-links').classList.add('-translate-x-full')">Statistik</a>
        <a href="#tim" onclick="document.getElementById('nav-links').classList.add('-translate-x-full')">Tim Kami</a>
        <a href="/login" class="mt-4 px-8 py-3 bg-white text-blue-900 rounded-full">Login Admin</a>
        <button id="close-menu" class="mt-8 p-2 text-slate-400 hover:text-white" aria-label="close menu">✕ Tutup</button>
      </div>
    </div>

    <main class="flex-grow">

      <section class="relative w-full py-20 lg:py-28 overflow-hidden bg-slate-50 dark:bg-slate-900">
        <div class="container mx-auto px-6 md:px-8 lg:px-16 xl:px-24">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="z-10">
              <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-700 text-xs font-bold tracking-wide mb-4">TUGAS AKHIR SEMESTER</span>
              <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 dark:text-white leading-tight mb-6">
                Sistem Akuisisi Data <span class="text-blue-600">Laboratorium</span>
              </h1>
              <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 leading-relaxed">
                Platform digital untuk mencatat, mengolah (preprocessing), dan memvisualisasikan data peminjaman alat serta stok bahan praktikum secara <i>real-time</i>.
              </p>
              <div class="flex flex-col sm:flex-row gap-4">
                <a href="/input-data" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg shadow-blue-500/30 text-center transition">
                  Mulai Input Data
                </a>
                <a href="/dashboard" class="px-8 py-4 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-blue-600 font-semibold shadow-sm text-center transition">
                  Lihat Dashboard
                </a>
              </div>
            </div>

            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 bg-white">
               <img src="{{ asset('assets/L.jpg') }}" alt="Sistem Lab" class="w-full h-auto object-cover transform hover:scale-105 transition duration-700" />

              <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur p-4 rounded-lg shadow-lg border border-slate-100">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xs font-bold text-slate-500 uppercase">Total Transaksi</span>
                    <span class="text-xs text-green-600 font-bold">+12% Minggu ini</span>
                </div>
                <div class="text-2xl font-bold text-slate-800">{{ $totalTransactions ?? 0 }} Data</div>
                <div class="w-full bg-slate-200 h-1.5 rounded-full mt-2">
                  @php $bar = min($accuracy ?? 0, 100); @endphp
                  <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $bar }}%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="fitur" class="py-20 bg-white dark:bg-slate-900">
        <div class="container mx-auto px-6 md:px-8 lg:px-16 xl:px-24">
          <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Fitur Utama Sistem</h2>
            <p class="text-slate-600 dark:text-slate-400">Dirancang untuk memenuhi kebutuhan akuisisi data inventaris pendidikan dengan arsitektur modern.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition duration-300">
              <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-2xl mb-6">🗄️</div>
              <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Manajemen Basis Data</h3>
              <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                Mengelola 3 tabel utama yang saling berelasi:
                <span class="font-semibold text-blue-600">Data Alat</span>,
                <span class="font-semibold text-blue-600">Data Mahasiswa</span>, dan
                <span class="font-semibold text-blue-600">Data Peminjaman</span>.
              </p>
            </div>

            <div class="p-8 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition duration-300">
              <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center text-2xl mb-6">⚙️</div>
              <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Preprocessing Data</h3>
              <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                Fitur otomatis untuk membersihkan "Raw Data" inputan pengguna menjadi data bersih yang siap dianalisis statistik.
              </p>
            </div>

            <div class="p-8 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition duration-300">
              <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-2xl mb-6">📊</div>
              <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Visualisasi Dashboard</h3>
              <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                Menampilkan statistik metadata seperti jumlah kerusakan alat, frekuensi peminjaman per jurusan, dan status stok.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section id="statistik" class="py-20 bg-slate-900 text-white">
        <div class="container mx-auto px-6 md:px-8 lg:px-16 xl:px-24">
          <div class="flex flex-col md:flex-row justify-between items-end mb-12">
            <div>
              <h2 class="text-3xl font-bold mb-4">Statistik Metadata</h2>
              <p class="text-slate-400 max-w-xl">Gambaran umum data yang telah diakuisisi oleh sistem saat ini.</p>
            </div>
            <a href="/dashboard" class="mt-4 md:mt-0 text-blue-400 hover:text-white font-medium flex items-center gap-2">
              Lihat Data Lengkap <span>→</span>
            </a>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-6 bg-slate-800 rounded-xl border border-slate-700">
              <div class="text-4xl font-bold text-blue-500 mb-2">{{ $totalTransactions ?? 0 }}</div>
              <div class="text-sm text-slate-400">Total Transaksi</div>
            </div>
            <div class="p-6 bg-slate-800 rounded-xl border border-slate-700">
              <div class="text-4xl font-bold text-purple-500 mb-2">{{ $activeTransactions ?? 0 }}</div>
              <div class="text-sm text-slate-400">Peminjaman Aktif</div>
            </div>
            <div class="p-6 bg-slate-800 rounded-xl border border-slate-700">
              <div class="text-4xl font-bold text-green-500 mb-2">{{ $damageReports ?? 0 }}</div>
              <div class="text-sm text-slate-400">Laporan Kerusakan</div>
            </div>
            <div class="p-6 bg-slate-800 rounded-xl border border-slate-700">
              <div class="text-4xl font-bold text-orange-500 mb-2">{{ $accuracy ?? 0 }}%</div>
              <div class="text-sm text-slate-400">Akurasi Data</div>
            </div>
          </div>
        </div>
      </section>

      <section id="tim" class="py-20 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800">
        <div class="container mx-auto px-6 md:px-8 lg:px-16 xl:px-24">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Tim Pengembang (Kelompok 8)</h2>
                <p class="mt-2 text-slate-600">Mahasiswa Informatika - Kelas A</p>
            </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="group">
              <div class="relative overflow-hidden rounded-xl mb-4">
                <img src="{{ asset('assets/FAHMI.jpg') }}" alt="Member" class="w-full h-64 object-cover object-center group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-lg font-bold text-slate-900 dark:text-white">NIM: 230533609604</span>
                </div>
              </div>
              <h3 class="text-lg font-bold text-slate-900 dark:text-white">ACHMAD MUZAMMI FAHMI</h3>
              <p class="text-sm text-blue-600 font-medium">Full Stack & Database</p>
            </div>

            <div class="group">
              <div class="relative overflow-hidden rounded-xl mb-4">
                <img src="{{ asset('assets/ARIF.jpg') }}" alt="Member" class="w-full h-64 object-cover object-center group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-lg font-bold text-slate-900 dark:text-white">NIM: 230533610158</span>
                </div>
              </div>
              <h3 class="text-lg font-bold text-slate-900 dark:text-white">ACHMAD ARIF SETIAWAN</h3>
              <p class="text-sm text-blue-600 font-medium">Frontend UI/UX</p>
            </div>

            <div class="group">
              <div class="relative overflow-hidden rounded-xl mb-4">
                <img src="{{ asset('assets/NISA.jpg') }}" alt="Member" class="w-full h-64 object-cover object-center group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-lg font-bold text-slate-900 dark:text-white">NIM: 230533601886</span>
                </div>
              </div>
              <h3 class="text-lg font-bold text-slate-900 dark:text-white">ANISATUL QOMARIYAH</h3>
              <p class="text-sm text-blue-600 font-medium">Data Logic & Process</p>
            </div>

            <div class="group">
              <div class="relative overflow-hidden rounded-xl mb-4">
                <img src="{{ asset('assets/ARIF.jpg') }}" alt="Member" class="w-full h-64 object-cover object-center group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-lg font-bold text-slate-900 dark:text-white">NIM: 230533605510</span>
                </div>
              </div>
              <h3 class="text-lg font-bold text-slate-900 dark:text-white">AMALIA PRAMESWARI ALVINA</h3>
              <p class="text-sm text-blue-600 font-medium">Documentation & Testing</p>
            </div>
          </div>
        </div>
      </section>

      <footer class="bg-slate-50 dark:bg-black border-t border-slate-200 dark:border-slate-800 pt-16 pb-8">
        <div class="container mx-auto px-6 md:px-8 lg:px-16 xl:px-24 text-center">
            <div class="flex items-center justify-center gap-2 font-bold text-xl text-slate-700 dark:text-white mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.31"/><path d="M14 2v7.31"/><path d="M8.5 2h7"/><path d="M14 9.3a6.5 6.5 0 1 1-4 0"/><path d="M5.52 16h12.96"/></svg>
                <span>SIPL Kampus</span>
            </div>
            <p class="text-slate-500 text-sm mb-8">
                Dibuat untuk memenuhi Tugas Mata Kuliah Data Science <br>
                Program Studi S1 Pendidikan Teknik Informatika - Semester 5
            </p>
            <div class="text-slate-400 text-xs">
                &copy; {{ date('Y') }} Kelompok 8. All rights reserved.
            </div>
        </div>
      </footer>
    </main>

    <script>
      // Toggle Mobile Menu
      const menuBtn = document.getElementById('menu-button');
      const closeBtn = document.getElementById('close-menu');
      const navLinks = document.getElementById('nav-links');

      menuBtn.addEventListener('click', () => {
        navLinks.classList.remove('-translate-x-full');
      });

      closeBtn.addEventListener('click', () => {
        navLinks.classList.add('-translate-x-full');
      });

      // Close when clicking overlay
      navLinks.addEventListener('click', (e) => {
        if(e.target === navLinks) navLinks.classList.add('-translate-x-full');
      });
    </script>
  </body>
</html>
