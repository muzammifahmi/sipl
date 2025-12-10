<section>
    <header>
        <h2 class="text-lg font-medium text-diamond-900 dark:text-diamond-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-diamond-700 dark:bg-diamond-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-diamond-600 dark:hover:bg-diamond-500 focus:bg-diamond-600 active:bg-diamond-900 focus:outline-none focus:ring-2 focus:ring-diamond-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-diamond-600 dark:text-diamond-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
