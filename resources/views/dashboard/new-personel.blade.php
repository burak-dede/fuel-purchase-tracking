<x-dashboard-layout>
    <div>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('yeniPersonel') }}">
        @csrf

        <!-- Name -->
            <div>
                <x-label for="name" :value="__('auth.name')" />

                <x-input id="name" class="block mt-1 w-full uppercase" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            <!-- Lastname -->
            <div>
                <x-label class="mt-4" for="lastname" :value="__('auth.lastname')" />

                <x-input id="lastname" class="block mt-1 w-full uppercase" type="text" name="lastname" :value="old('lastname')" required autofocus />
            </div>
            <!-- Username -->
            <div>
                <x-label class="mt-4" for="username" :value="__('auth.username')" />

                <x-input id="username" class="block mt-1 w-full lowercase" style="text-transform: lowercase" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('auth.password')" />

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('auth.register') }}
                </x-button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
