<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register', $plan) }}">
            @csrf
            <div class="w-100 d-flex justify-center">
                <img class="mylogo" src="/img/small_logo.png" alt="logo" />
            </div>
            <div class="w-100 d-flex justify-center mt-3">
                <img class="profile-pic" src="/img/picture.jpg" alt="logo" />
            </div>
            <div class="text-center mb-2"><a class="upload-link" href="#">{{ __('Upload photo') }} </a></div>
            <h2 class="text-center reg-title mb-2">{{ __('Register') }}</h2>
            <div class="row">
                <div class="col-md-6">
                   <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>
                    <!-- Password -->
                    <div class="mt-3">
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                    </div>
                    <!-- Role -->
                    <div class="mt-3">
                        <x-label for="role" :value="__('Function')" />
                        <x-input id="role" class="block mt-1 w-full" type="text" name="role" :value="__('Trainer')" required autofocus disabled/>
                    </div>

                </div>
                <div class="col-md-6">
                    <!-- Email Address -->
                    <div >
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>
                    <!-- School -->
                    <div class="mt-3">
                        <x-label for="school" :value="__('Company-school')" />
                        <x-input id="school" class="block mt-1 w-full" type="text" name="school"  />
                    </div>
                    <!-- Land -->
                    <div class="mt-3">
                        <x-label for="land" :value="__('Land')" />
                        <x-select id="land_id" class="block mt-1 w-full" name="land_id"  :options="$lands"/>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center mt-4">

                <button type="submit" class="ml-4 btn btn-orange uppercase">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
