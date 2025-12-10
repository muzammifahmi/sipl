<section>
    <header>
        <h2 class="text-lg font-medium text-diamond-900 dark:text-diamond-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-diamond-900 dark:text-diamond-100" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-slate-800 dark:text-slate-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-diamond-600 hover:text-diamond-800 dark:text-diamond-400 dark:hover:text-diamond-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-diamond-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-diamond-700 dark:bg-diamond-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-diamond-600 dark:hover:bg-diamond-500 focus:bg-diamond-600 active:bg-diamond-900 focus:outline-none focus:ring-2 focus:ring-diamond-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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
