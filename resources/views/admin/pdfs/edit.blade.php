<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">✏️ تعديل ملف PDF</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div
                    class="mb-6 bg-red-100 dark:bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong>حدثت أخطاء:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 p-8 rounded shadow">
                <form action="{{ route('admin.pdfs.update', $pdf) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @php
                        $categories = ['رواية', 'تاريخ', 'علم', 'أدب', 'دين'];
                    @endphp
                    @method('PUT')

                    <!-- العنوان -->
                    <div class="mb-4">
                        <x-input-label for="title" :value="'عنوان الملف'" class="dark:text-gray-300" />
                        <x-text-input type="text" name="title" id="title"
                            class="mt-1 block w-full dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            value="{{ old('title', $pdf->title) }}" required />
                    </div>

                    <!-- الوصف -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="'الوصف'" class="dark:text-gray-300" />
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $pdf->description) }}</textarea>
                    </div>

                    <!-- الثمن -->
                    <div class="mb-4">
                        <x-input-label for="price" :value="'السعر (درهم)'" class="dark:text-gray-300" />
                        <x-text-input type="number" name="price" id="price"
                            class="mt-1 block w-full dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            value="{{ old('price', $pdf->price) }}" required />
                    </div>

                    <!-- حقل التصنيف -->
                    <div class="mb-4">
                        <x-input-label for="category" :value="'التصنيف'" class="dark:text-gray-300" />
                        <select name="category" id="category"
                            class="mt-1 block w-full dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded-md shadow-sm">
                            <option value="">اختر تصنيفاً</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}"
                                    {{ old('category', $pdf->category) == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- صورة PDF -->
                    <div class="mb-4">
                        <x-input-label for="image" :value="'تحديث صورة الملف'" class="dark:text-gray-300" />
                        <input type="file" name="image" id="image"
                            class="mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded-md shadow-sm"
                            accept="image/*">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">اترك هذا الحقل فارغاً إن كنت لا تريد
                            تغييره.</p>

                        @if ($pdf->image_path)
                            <img src="{{ asset('storage/' . $pdf->image_path) }}" alt="صورة الملف"
                                class="w-32 h-32 object-cover mt-2 rounded shadow">
                        @endif
                    </div>

                    <!-- تغيير الملف PDF -->
                    <div class="mb-4">
                        <x-input-label for="pdf_file" :value="'تحديث الملف (PDF)'" class="dark:text-gray-300" />
                        <input type="file" name="pdf_file" id="pdf_file"
                            class="mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded-md shadow-sm"
                            accept=".pdf">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">اترك هذا الحقل فارغاً إن كنت لا تريد
                            تغييره.</p>
                    </div>

                    <!-- زر الحفظ -->
                    <div class="mt-6 flex justify-end">
                        <x-primary-button class="dark:bg-indigo-600 dark:hover:bg-indigo-700">
                            💾 حفظ التغييرات
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
