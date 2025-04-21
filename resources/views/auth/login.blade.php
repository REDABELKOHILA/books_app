{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center text-indigo-700 dark:text-indigo-400 mb-6">🔐 تسجيل الدخول</h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="'📧 البريد الإلكتروني'" class="dark:text-gray-300" />
            <x-text-input id="email"
                          class="block mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                          type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="'🔑 كلمة المرور'" class="dark:text-gray-300" />
            <x-text-input id="password"
                          class="block mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                          type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between mb-4">
            <label for="remember_me" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-300">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-500"
                       name="remember">
                <span class="ml-2">تذكرني</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:underline dark:text-indigo-400" href="{{ route('password.request') }}">
                    نسيت كلمة المرور؟
                </a>
            @endif
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                دخول
            </x-primary-button>
        </div>
    </form>

    <!-- Link to register -->
    <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-300">
        ما عندكش حساب؟
        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium dark:text-indigo-400">
            سجل الآن
        </a>
    </div>
</div>
@endsection
