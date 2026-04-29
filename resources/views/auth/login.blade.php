<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-800 font-bold" />
            <x-text-input id="email" class="block mt-1 w-full bg-white/50 border-white/30 focus:border-med-blue focus:ring-med-blue" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-slate-800 font-bold" />

            <x-text-input id="password" class="block mt-1 w-full bg-white/50 border-white/30 focus:border-med-blue focus:ring-med-blue" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-med-blue shadow-sm focus:ring-med-blue" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-slate-800 hover:text-med-green rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-med-blue font-medium"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-med-green hover:bg-med-teal text-white font-bold">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>