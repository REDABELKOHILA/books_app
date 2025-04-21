@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-6 py-12 text-center">
        <h1 class="text-3xl font-bold text-green-600 dark:text-green-400 mb-4">تم الدفع بنجاح 🎉</h1>
        <p class="text-lg mb-6 text-gray-700 dark:text-gray-300">شكراً على الشراء! يمكنك الآن تحميل الملف.</p>
        <a href="{{ route('pdfs.download', $pdf->id) }}"
           class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 transition">
            📥 تحميل الملف
        </a>
    </div>
@endsection
