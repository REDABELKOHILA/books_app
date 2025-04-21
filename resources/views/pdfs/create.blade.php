@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 shadow rounded">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">📤 رفع ملف PDF جديد</h2>

    <form action="{{ route('pdfs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-gray-700 dark:text-gray-300">العنوان</label>
            <input type="text" name="title" class="w-full border rounded p-2 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700 dark:text-gray-300">الوصف</label>
            <textarea name="description" class="w-full border rounded p-2 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700 dark:text-gray-300">السعر (درهم)</label>
            <input type="number" name="price" step="0.01" class="w-full border rounded p-2 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700 dark:text-gray-300">ملف PDF</label>
            <input type="file" name="file" accept="application/pdf" class="w-full border rounded p-2 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">📥 رفع</button>
    </form>
</div>
@endsection
