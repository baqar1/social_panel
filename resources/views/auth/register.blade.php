<x-guest-layout>
    <form method="POST" action="{{ route('welcome') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('First_Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Last_Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>
       
        {{-- <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <x-select id="gender" class="block mt-1 w-full" name="gender" :value="old('gender')" required>
                <option value="">-- Select a gender --</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </x-select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div> --}}
        <div>
            <x-input-label for="name" :value="__('Date of Birthday')" />
            <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required autofocus autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="department_id" :value="__('Department Name')" />
            <x-text-input id="department_id" class="block mt-1 w-full" type="text" name="department_id" :value="old('department_id')" required autofocus autocomplete="department_id" />
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="batch" :value="__('Batch')" />
            <x-text-input id="batch" class="block mt-1 w-full" type="text" name="batch" :value="old('batch')" required autofocus autocomplete="batch" />
            <x-input-error :messages="$errors->get('batch')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="semester" :value="__('Semester')" />
            <x-text-input id="semester" class="block mt-1 w-full" type="text" name="semester" :value="old('semester')" required autofocus autocomplete="semester" />
            <x-input-error :messages="$errors->get('semester')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
