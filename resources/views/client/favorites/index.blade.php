@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300 text-center mb-10">
            ❤️ ملفاتك المفضلة
        </h1>

        @if ($favorites->isEmpty())
            <div class="text-center text-gray-600 dark:text-gray-400 text-lg">
                لا توجد ملفات مفضلة حاليا. جرب تضيف بعض الملفات!
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($favorites as $pdf)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl overflow-hidden hover:shadow-xl transition duration-300 flex flex-col h-full">
                        @if ($pdf->image_path)
                            <img src="{{ asset('storage/' . $pdf->image_path) }}" alt="{{ $pdf->title }}"
                                class="w-full h-48 object-cover">
                        @endif

                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $pdf->title }}</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex-grow">
                                {{ Str::limit($pdf->description, 80, '...') }}
                            </p>

                            <div class="mt-auto flex justify-between items-center">
                                <a href="{{ route('pdfs.show', $pdf->id) }}"
                                    class="text-indigo-600 dark:text-indigo-300 text-sm hover:underline">
                                    📄 عرض الملف
                                </a>

                                <form action="{{ route('client.favorites.destroy', $pdf->id) }}" method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من إزالة هذا الملف من المفضلة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 dark:text-red-400 hover:text-red-700 text-sm">
                                        ❌ إزالة
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
