{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center text-indigo-700 dark:text-indigo-400 mb-6">📥 إنشاء حساب جديد</h2>

    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600 bg-red-100 dark:bg-red-200 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="'👤 الاسم الكامل'" class="dark:text-gray-300" />
            <x-text-input id="name"
                          class="block mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                          type="text" name="name" :value="old('name')" required autofocus />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="'📧 البريد الإلكتروني'" class="dark:text-gray-300" />
            <x-text-input id="email"
                          class="block mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                          type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="'🔐 كلمة المرور'" class="dark:text-gray-300" />
            <x-text-input id="password"
                          class="block mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                          type="password" name="password" required />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="'🔁 تأكيد كلمة المرور'" class="dark:text-gray-300" />
            <x-text-input id="password_confirmation"
                          class="block mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                          type="password" name="password_confirmation" required />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-indigo-600 underline dark:text-gray-300 dark:hover:text-indigo-400">
                عندك حساب؟ تسجيل الدخول
            </a>

            <x-primary-button class="px-6 py-2">
                تسجيل
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
