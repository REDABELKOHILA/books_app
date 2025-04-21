<!DOCTYPE html>
<html lang="ar" dir="rtl" class="min-h-screen">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen ">

    {{-- النافبار --}}
    @include('layouts.nav')

    {{-- محتوى الصفحة --}}
    <main class="px-6 py-4 max-w-7xl mx-auto">
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header ?? '' }}
            </div>
        </header>

        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>

    @include('layouts.footer')

    @stack('scripts')
<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Persist Plugin -->
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.plugin(window.AlpinePersist);
    });
</script>



</body>
</html>
