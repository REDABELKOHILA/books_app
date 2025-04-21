<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">➕ إضافة ملف PDF جديد</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-6 bg-red-100 dark:bg-red-200 text-red-700 p-4 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pdfs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                @csrf
                @php
                $categories = ['الاقتصاد','التنمية البشرية','رواية', 'تاريخ', 'علم', 'أدب', 'دين'];
            @endphp
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">عنوان الملف</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">الوصف</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">السعر (درهم)</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}"
                           class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                </div>
                        <!-- تصنيف -->
        <div class="mb-4">
            <x-input-label for="category" :value="'التصنيف'" class="dark:text-gray-300" />
            <select name="category" id="category"
                class="mt-1 block w-full dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded-md shadow-sm">
                <option value="">اختر تصنيفاً</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>

                <div class="mb-6">
                    <label for="file" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">رفع الملف (PDF)</label>
                    <input type="file" name="file" id="file"
                           class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">صورة الملف (اختياري)</label>
                    <input type="file" name="image" id="image"
                           class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.pdfs.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 dark:text-white rounded hover:bg-gray-300 dark:hover:bg-gray-500">⬅️ رجوع</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 shadow">
                        💾 حفظ الملف
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
