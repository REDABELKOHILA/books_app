@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
            @if ($pdf->image_path)
                <img src="{{ asset('storage/' . $pdf->image_path) }}" alt="{{ $pdf->title }}"
                    class="w-full h-64 object-cover">
            @endif

            <div class="p-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    {{ $pdf->title }}
                </h1>

                <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed mb-6">
                    {{ $pdf->description }}
                </p>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                    <span class="text-xl font-semibold text-indigo-600 dark:text-indigo-400">
                        💰 السعر: {{ $pdf->price }} درهم
                    </span>

                    @auth
                        @if (auth()->user()->purchases->contains('pdf_id', $pdf->id))
                            <a href="{{ route('pdfs.download', $pdf->id) }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg transition">
                                📥 تحميل الملف
                            </a>
                        @else
                            <a href="{{ route('payment.checkout', $pdf->id) }}"
                               class="inline-block bg-green-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-green-700 transition">
                                💳 شراء الآن
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium text-sm px-6 py-3 rounded-lg transition duration-300">
                            🔐 سجل الدخول لشراء الملف
                        </a>
                    @endauth
                </div>

                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg text-sm text-gray-600 dark:text-gray-300">
                    <p><span class="font-semibold text-gray-700 dark:text-gray-200">المسار:</span> {{ $pdf->file_path }}</p>
                    <p class="mt-2"><span class="font-semibold text-gray-700 dark:text-gray-200">تم الإنشاء في:</span>
                        {{ $pdf->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
