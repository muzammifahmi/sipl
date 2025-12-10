<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-diamond-900 dark:text-diamond-100" />

            <x-text-input id="password"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-diamond-600 shadow-sm focus:ring-diamond-500 dark:focus:ring-diamond-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-slate-600 dark:text-slate-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-diamond-600 dark:text-diamond-400 hover:text-diamond-900 dark:hover:text-diamond-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-diamond-500 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-diamond-700 dark:bg-diamond-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-diamond-600 dark:hover:bg-diamond-500 focus:bg-diamond-600 active:bg-diamond-900 focus:outline-none focus:ring-2 focus:ring-diamond-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
