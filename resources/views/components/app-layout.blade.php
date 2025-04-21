<!-- resources/views/components/app-layout.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- النافبار --}}
    @include('layouts.nav')

    {{-- محتوى الصفحة --}}
    <main class="px-6 py-4 max-w-7xl mx-auto">

        {{-- الهيدر (اختياري) --}}
        @isset($header)
            <header class="mb-6">
                {{ $header }}
            </header>
        @endisset

        {{ $slot }}
    </main>
</body>
</html>
