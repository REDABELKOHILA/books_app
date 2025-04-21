@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 text-center">
        <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">تأكيد الشراء</h1>
        <p class="mb-4 text-gray-700 dark:text-gray-300">
            هل ترغب في شراء
            <span class="font-semibold dark:text-white">{{ $pdf->title }}</span>
            مقابل
            <span class="text-indigo-600 dark:text-indigo-400">{{ $pdf->price }} درهم</span>؟
        </p>
        <form method="POST" action="{{ route('purchase.pdf', $pdf) }}">
            @csrf
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
                ✅ نعم، اشتر الآن
            </button>
        </form>
    </div>
</div>
@endsection
