{{-- resources/views/client/downloads/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">📁 تحميلاتي</h1>

    @if ($downloads->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">ليس لديك أي تحميلات بعد.</p>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach ($downloads as $pdf)
                <div class="border p-4 rounded-lg shadow-sm bg-white dark:bg-gray-800 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $pdf->title }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $pdf->description }}</p>
                    </div>
                    <a href="{{ route('pdfs.download', $pdf) }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                        📥 تحميل
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
