{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-extrabold text-gray-800 dark:text-gray-100">
            ⚙️ تعديل الملف الشخصي
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Form: Update Profile -->
            <form method="post" action="{{ route('client.profile.update') }}" class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-200">الإسم</label>
                    <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-200">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                @if (session('status') === 'profile-updated')
                    <div class="text-green-600 dark:text-green-400">تم التحديث بنجاح.</div>
                @endif

                <div class="flex justify-end">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">حفظ التعديلات</button>
                </div>
            </form>

            <!-- Optional: Delete Account -->
            <form method="post" action="{{ route('client.profile.destroy') }}" class="bg-red-50 dark:bg-red-900 p-6 rounded-2xl shadow space-y-4">
                @csrf
                @method('delete')

                <h3 class="text-red-700 dark:text-red-200 text-lg font-bold">⚠️ حذف الحساب</h3>
                <p class="text-sm text-red-600 dark:text-red-300">هاد الإجراء لا يمكن التراجع عنه. سيتم حذف الحساب نهائياً.</p>

                <div class="flex justify-end">
                    <button onclick="return confirm('هل أنت متأكد من حذف الحساب؟')" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">حذف الحساب</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

