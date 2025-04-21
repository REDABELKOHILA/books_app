@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-indigo-600 mb-8 text-center">📚 لائحة الكاتيجوريات</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($categories as $category)
            <a href="{{ route('client.categories.show', urlencode($category)) }}"
            class="block border border-gray-300 dark:border-gray-600 rounded-xl hover:shadow-md transition duration-300">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                    📖 {{ $category }}
                </h2>
            </div>
        </a>

            @empty
                <p class="text-center col-span-3 text-gray-600 dark:text-gray-300">لا توجد كاتيجوريات حاليا.</p>
            @endforelse
        </div>
    </div>
@endsection
