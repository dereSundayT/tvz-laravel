<x-guest-layout>
    @include('layouts.utils.alert')
    <form method="POST" action="{{ route('complete-registration',$token) }}" enctype="multipart/form-data">
        @csrf
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required autocomplete="username" disabled />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full"
                          type="text"
                          name="name"
                          required/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full"
                          type="text"
                          name="username" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- profile_photo -->
        <div class="mt-4">
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <x-text-input id="profile_image" class="block mt-1 w-full"
                          type="file"
                          name="profile_image" required autocomplete="profile_image" />
            <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Complete Profile') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
