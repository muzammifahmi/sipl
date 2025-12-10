<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/95 dark:bg-slate-900/95 backdrop-blur border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.31"/><path d="M14 2v7.31"/><path d="M8.5 2h7"/><path d="M14 9.3a6.5 6.5 0 1 1-4 0"/><path d="M5.52 16h12.96"/></svg>
                        <span class="font-bold text-slate-800 dark:text-white hidden md:block">SIPL</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400">
                        <i class="w-4 h-4 mr-2">📊</i>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none transition ease-in-out duration-150">
                                    <i class="w-4 h-4 mr-1">🗄️</i>
                                    {{ __('Manajemen Data') }}
                                    <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('peminjaman.create')">
                                    <i class="w-4 h-4 mr-2 text-blue-600">📝</i>
                                    {{ __('Input Peminjaman') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                                <div class="px-4 py-1 text-xs text-gray-400 uppercase font-bold">Tabel Database</div>

                                <x-dropdown-link :href="route('barang.index')">
                                    <i class="w-4 h-4 mr-2">🔬</i>
                                    {{ __('Data Barang (Inventaris)') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('mahasiswa.index')">
                                    <i class="w-4 h-4 mr-2">👨‍🎓</i>
                                    {{ __('Data Mahasiswa') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('peminjaman.index')">
                                    <i class="w-4 h-4 mr-2">📑</i>
                                    {{ __('Data Transaksi') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none transition ease-in-out duration-150">
                                    <i class="w-4 h-4 mr-1">⚙️</i>
                                    {{ __('Preprocessing') }}
                                    <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('preprocessing.raw')">
                                    <i class="w-4 h-4 mr-2">🌫️</i>
                                    {{ __('Lihat Data Mentah (Raw)') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('preprocessing.clean')">
                                    <i class="w-4 h-4 mr-2">✨</i>
                                    {{ __('Lihat Data Bersih (Clean)') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 dark:text-slate-400 bg-transparent hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <i class="w-4 h-4 mr-2">👤</i>
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-slate-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-slate-900 border-t border-gray-100 dark:border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-blue-600 bg-blue-50 border-blue-400">
                <i class="w-4 h-4 mr-2">📊</i>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <div class="px-4 pt-4 pb-1">
                <div class="font-bold text-xs text-slate-400 uppercase tracking-wider">Database Lab</div>
            </div>
            <x-responsive-nav-link href="#">
                <i class="w-4 h-4 mr-2">📝</i> {{ __('Input Peminjaman') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                <i class="w-4 h-4 mr-2">🔬</i> {{ __('Data Barang') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                <i class="w-4 h-4 mr-2">👨‍🎓</i> {{ __('Data Mahasiswa') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                <i class="w-4 h-4 mr-2">📑</i> {{ __('Data Transaksi') }}
            </x-responsive-nav-link>

            <div class="px-4 pt-4 pb-1">
                <div class="font-bold text-xs text-slate-400 uppercase tracking-wider">Preprocessing</div>
            </div>
            <x-responsive-nav-link :href="route('preprocessing.raw')">
                <i class="w-4 h-4 mr-2">🌫️</i> {{ __('Data Mentah') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('preprocessing.clean')">
                <i class="w-4 h-4 mr-2">✨</i> {{ __('Data Bersih') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700 bg-slate-50 dark:bg-black/20">
            <div class="px-4">
                <div class="font-medium text-base text-slate-800 dark:text-slate-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
