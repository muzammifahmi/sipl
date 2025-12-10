<x-guest-layout>
    <div class="mb-4 text-sm text-slate-600 dark:text-slate-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-diamond-700 dark:bg-diamond-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-diamond-600 dark:hover:bg-diamond-500 focus:bg-diamond-600 active:bg-diamond-900 focus:outline-none focus:ring-2 focus:ring-diamond-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
