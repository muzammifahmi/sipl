<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="name"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                type="text"
                name="name"
                :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                type="email"
                name="email"
                :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-diamond-900 dark:text-diamond-100" />

            <x-text-input id="password"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                type="password"
                name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-diamond-900 dark:text-diamond-100" />

            <x-text-input id="password_confirmation"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-diamond-600 dark:text-diamond-400 hover:text-diamond-900 dark:hover:text-diamond-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-diamond-500 transition-colors" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-diamond-700 dark:bg-diamond-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-diamond-600 dark:hover:bg-diamond-500 focus:bg-diamond-600 active:bg-diamond-900 focus:outline-none focus:ring-2 focus:ring-diamond-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
