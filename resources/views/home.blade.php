{{-- @extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-gray-800 text-center mb-12">Explore Our PDF Library</h1>

        @if ($pdfs->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($pdfs as $pdf)
                    <div class="bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="p-6 flex flex-col justify-between h-full">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $pdf->title }}</h2>
                            <p class="text-sm text-gray-600 mb-4">
                                {{ Str::limit($pdf->description, 80, '...') }}
                            </p>
                            <div class="mt-auto">
                                <p class="text-blue-600 font-bold mb-3">Price: {{ $pdf->price }} MAD</p>
                                <a href="{{ route('pdfs.show', $pdf->id) }}"
                                   class="w-full inline-block text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition">
                                    View PDF
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-600 text-lg mt-20">
                No PDFs found for now. Please check back later!
            </div>
        @endif
        <div class="mt-6">
    {{ $pdfs->links() }}
</div>
    </div>
@endsection --}}



@extends('layouts.app')

{{-- @section('content')

    @if (session('status') === 'profile-updated')
        <div class="mb-8 p-4 bg-green-100 text-green-800 font-semibold text-center rounded-xl shadow-md">
            ✅ تم تحديث الملف الشخصي بنجاح.
        </div>
    @endif
    @if (session('status') === 'account-deleted')
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">
            ✅ تم حذف الحساب بنجاح. نتمناو نرجعو نشوفوك قريبا!
        </div>
    @endif
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-extrabold text-center text-indigo-700 dark:text-indigo-300 mb-12">
            📚 مكتبة ملفات الـ PDF

        </h1>

        @if ($pdfs->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($pdfs as $pdf)
                    <div
                        class="bg-white dark:bg-gray-800 shadow-md rounded-2xl overflow-hidden hover:shadow-xl transition duration-300 flex flex-col h-full">
                        @if ($pdf->image_path)
                            <img src="{{ asset('storage/' . $pdf->image_path) }}" alt="{{ $pdf->title }}"
                                class="w-full h-48 object-cover">
                        @endif

                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $pdf->title }}</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex-grow">
                                {{ Str::limit($pdf->description, 80, '...') }}
                            </p>
                            <div class="mt-auto">
                                <p class="text-indigo-600 dark:text-indigo-300 font-semibold text-sm mb-3">السعر:
                                    {{ $pdf->price }} درهم</p>
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
                لا توجد ملفات PDF حاليا. المرجو المحاولة لاحقا 📂
            </div>
        @endif
    </div>
@endsection --}}


@section('content')

    @if (session('status') === 'profile-updated')
        <div class="mb-8 p-4 bg-green-100 text-green-800 font-semibold text-center rounded-xl shadow-md">
            ✅ تم تحديث الملف الشخصي بنجاح.
        </div>
    @endif

    @if (session('status') === 'account-deleted')
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">
            ✅ تم حذف الحساب بنجاح. نتمناو نرجعو نشوفوك قريبا!
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-extrabold text-center text-indigo-700 dark:text-indigo-300 mb-12">
            📚 مكتبة ملفات الـ PDF
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

                                <!-- زر المفضلة -->
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
                لا توجد ملفات PDF حاليا. المرجو المحاولة لاحقا 📂
            </div>
        @endif
    </div>
@endsection
