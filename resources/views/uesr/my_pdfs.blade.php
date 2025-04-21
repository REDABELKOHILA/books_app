@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">الكتب التي اشتريتها</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($pdfs as $pdf)
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-lg font-semibold">{{ $pdf->title }}</h3>
                <p>{{ $pdf->description }}</p>
                <a href="{{ route('pdfs.download', $pdf) }}"
                   class="text-blue-500 hover:underline mt-2 inline-block">
                    تحميل PDF
                </a>
            </div>
        @empty
            <p>لم تقم بشراء أي كتب بعد.</p>
        @endforelse
    </div>
</div>
@endsection
