<x-guest-layout>
    <x-auth-card>
        
        <x-slot name="logo">
            <a href="/">
                
            </a>
        </x-slot>
        

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />

        
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Gym Class</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Add new gym class to the database?</h6>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
              </div>
            </div>
        </div>


        <div class="GIM-container" style="display: block; margin-left: auto; margin-right: auto;">
            
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

                    <x-input id="password" class="PASS-input" style="margin-bottom:40px;" 
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
                <!-- <div class="GIM-rememberMe" style="margin-left:240px;">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div> -->

                <!-- <div class="GIM-forgotPassword" style="margin-left: 240px; margin-bottom: 35px;">
                    @if (Route::has('password.request'))
                        <a class="GIM-whiteLinkForForgotPass" href="{{ route('password.request') }}" style="color: black;">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div> -->
                <div>
                    <x-button class="login addUserBtn">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>


<script>
    $(document).ready(function(){
        $('.addUserBtn').click(function(e){
            e.preventDefault();

            $('#addModal').modal('show');
        });

    });
</script>
