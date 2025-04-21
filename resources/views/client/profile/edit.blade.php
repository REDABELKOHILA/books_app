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

            <!-- ✅ تحديث المعلومات الشخصية -->
            <form method="post" action="{{ route('client.profile.update') }}"
                  class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow space-y-4">
                @csrf
                @method('patch')

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">📝 المعلومات الشخصية</h3>

                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-200">الإسم</label>
                    <input id="name" name="name" type="text"
                           class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white"
                           value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-200">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email"
                           class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white"
                           value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                @if (session('status') === 'profile-updated')
                    <div class="text-green-600 dark:text-green-400">✅ تم تحديث الملف الشخصي بنجاح.</div>
                @endif

                <div class="flex justify-end">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">💾 حفظ التعديلات</button>
                </div>
            </form>

            <!-- 🔐 تغيير كلمة المرور -->
            <form method="post" action="{{ route('password.update') }}"
                  class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow space-y-4">
                @csrf
                @method('put')

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">🔒 تغيير كلمة المرور</h3>

                <div>
                    <label for="current_password" class="block font-medium text-sm text-gray-700 dark:text-gray-200">كلمة المرور الحالية</label>
                    <input id="current_password" name="current_password" type="password" required
                           class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white" />
                    @error('current_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-200">كلمة المرور الجديدة</label>
                    <input id="password" name="password" type="password" required
                           class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white" />
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-200">تأكيد كلمة المرور الجديدة</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white" />
                </div>

                @if (session('status') === 'password-updated')
                    <div class="text-green-600 dark:text-green-400">✅ تم تغيير كلمة المرور بنجاح.</div>
                @endif

                <div class="flex justify-end">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">🔄 تحديث كلمة المرور</button>
                </div>
            </form>

            <!-- 🗑️ حذف الحساب -->
            <form method="post" action="{{ route('client.profile.destroy') }}"
                  class="bg-red-50 dark:bg-red-900 p-6 rounded-2xl shadow space-y-4">
                @csrf
                @method('delete')

                <h3 class="text-red-700 dark:text-red-200 text-lg font-bold">⚠️ حذف الحساب</h3>
                <p class="text-sm text-red-600 dark:text-red-300">هاد الإجراء لا يمكن التراجع عنه. سيتم حذف الحساب نهائياً.</p>

                <div>
                    <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-200">كلمة المرور</label>
                    <input id="password" name="password" type="password" required
                           class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white" />
                    @error('password', 'userDeletion')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                @if (session('status') === 'account-deleted')
                    <div class="text-green-600 dark:text-green-400">✅ تم حذف الحساب بنجاح.</div>
                @endif

                <div class="flex justify-end">
                    <button onclick="return confirm('هل أنت متأكد من حذف الحساب؟')"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">🗑️ حذف الحساب</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
