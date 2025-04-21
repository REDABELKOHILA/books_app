@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-extrabold text-center text-indigo-700 dark:text-indigo-300 mb-12">
        📘 كتب من تصنيف: {{ $category }}
    </h1>

    @if ($pdfs->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($pdfs as $pdf)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl overflow-hidden hover:shadow-xl transition duration-300 flex flex-col h-full">
                    @if ($pdf->image_path)
                        <img src="{{ asset('storage/' . $pdf->image_path) }}" alt="{{ $pdf->title }}"
                             class="w-full h-48 object-cover">
                    @endif

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $pdf->title }}</h2>

                            @auth
                                <form action="{{ route('client.favorites.toggle', $pdf->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition text-xl">
                                        @if(auth()->user()->favorites->contains($pdf->id))
                                            ❤️
                                        @else
                                            🤍
                                        @endif
                                    </button>
                                </form>
                            @endauth
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex-grow">
                            {{ Str::limit($pdf->description, 80, '...') }}
                        </p>

                        <div class="mt-auto">
                            <p class="text-indigo-600 dark:text-indigo-300 font-semibold text-sm mb-3">
                                السعر: {{ $pdf->price }} درهم
                            </p>
                            <a href="{{ route('pdfs.show', $pdf->id) }}"
                               class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 rounded-lg transition">
                                📄 مشاهدة الملف
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $pdfs->links() }}
        </div>
    @else
        <div class="text-center text-gray-600 dark:text-gray-300 text-lg mt-20">
            لا توجد كتب في هذا التصنيف حالياً. 📂
        </div>
    @endif
</div>
@endsection
