@extends('admin.layout')
@section('umt')
<div class="container" style="padding: 2%;">
    <div class="card" div >
        <div class="card-header"div style="color: #fff;background-color: #e44d3a;width:100%;">
            <b>Update Password</b>
        </div><br>
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

            <div class="card-body">

                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')
            
                    <div>
                        <x-input-label for="current_password" :value="__('Current Password')" />
                        <x-text-input id="current_password" style="margin-left: 10%; width:40%" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div><br>
            
                    <div>
                        <x-input-label for="password" :value="__('New Password')" />
                        <x-text-input id="password" style="margin-left: 11.9%; width:40%" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div><br>
            
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" style="margin-left: 9.7%; width:40%" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div><br><br>
            
                    <div class="flex items-center gap-4">
                        <x-primary-button style="background-color: #e44d3a">{{ __('Save') }}</x-primary-button>
            
                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __() }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
