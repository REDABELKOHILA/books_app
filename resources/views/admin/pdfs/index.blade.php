<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">📂 إدارة ملفات PDF</h2>
            <a href="{{ route('admin.pdfs.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                ➕ إضافة ملف جديد
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            @if ($pdfs->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($pdfs as $pdf)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden flex flex-col">
                            @if ($pdf->image_path)
                                <img src="{{ asset('storage/' . $pdf->image_path) }}" alt="صورة PDF"
                                    class="w-full h-48 object-cover">
                            @endif

                            <div class="p-6 flex flex-col flex-grow justify-between">
                                <div>
                                    <h3 class="text-xl font-semibold text-indigo-700 dark:text-indigo-400 mb-2">{{ $pdf->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">{{ $pdf->description }}</p>
                                    <span class="inline-block bg-indigo-100 dark:bg-indigo-500/20 text-indigo-800 dark:text-indigo-300 text-sm px-3 py-1 rounded-full">
                                        💰 {{ $pdf->price }} درهم
                                    </span>
                                </div>

                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('admin.pdfs.edit', $pdf) }}"
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">✏️ تعديل</a>

                                    <form method="POST" action="{{ route('admin.pdfs.destroy', $pdf) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('هل أنت متأكد من الحذف؟')"
                                            class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-medium">
                                            🗑️ حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $pdfs->links() }}
                </div>
            @else
                <div class="text-center py-12 text-gray-500 dark:text-gray-400 text-lg">
                    لا توجد ملفات PDF حالياً.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
