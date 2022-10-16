<x-guest-layout>
    <x-auth-card>
        
        <x-slot name="logo">
            <a href="/">
                
            </a>
        </x-slot>
        

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="GIM-container">
            <form method="POST" action="{{ route('login') }}">
                
                <div>
                    <h1 class="GIM-header">GIM</h1>
                </div>
                
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" class="USER-label"/>

                    <x-input id="email" class="USER-input" type="email" name="email" :value="old('email')" required autofocus />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                
                </div>

                <!-- Password -->
                <div>
                    <x-label for="password" :value="__('Password')" class="PASS-label"/>

                    <x-input id="password" class="PASS-input" 
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                        @error('password')
                            <span class="error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="login">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
