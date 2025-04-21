@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-extrabold text-indigo-700 dark:text-indigo-400 mb-8 text-center">
            🔍 نتائج البحث عن: <span class="text-gray-800 dark:text-white">"{{ $query }}"</span>
        </h2>

        @if ($pdfs->isEmpty())
            <div class="text-center text-gray-500 dark:text-gray-400 text-lg">
                ❌ لا يوجد كتب تطابق بحثك.
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($pdfs as $pdf)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 flex flex-col justify-between h-[330px] transition hover:-translate-y-1 hover:shadow-xl duration-300 overflow-hidden">
                        <div>
                            <h3 class="text-xl font-semibold text-indigo-800 dark:text-indigo-300 mb-3 truncate">
                                {{ $pdf->title }}
                            </h3>
                            <p class="text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border-l-4 border-indigo-500 pl-4 pr-3 py-3 rounded-md shadow-sm hover:bg-indigo-50 dark:hover:bg-gray-600 transition duration-300 ease-in-out mb-4 h-[110px] overflow-hidden">
                                {{ Str::limit($pdf->description, 180) }}
                            </p>
                        </div>

                        <a href="{{ route('pdfs.show', $pdf->id) }}"
                           class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-full text-sm font-medium transition text-center mt-auto">
                            📘 عرض التفاصيل
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
