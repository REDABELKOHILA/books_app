<nav x-data="{ darkMode: localStorage.getItem('theme') === 'dark', profileMenu: false }" x-init="$watch('darkMode', val => {
    localStorage.setItem('theme', val ? 'dark' : 'light');
    document.documentElement.classList.toggle('dark', val);
})"
    class="fixed top-0 w-full z-50 bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-gray-900 dark:to-gray-800 p-4 shadow-md">
    <div class="container mx-auto flex justify-center">
        <ul class="flex flex-wrap justify-center items-center gap-6 text-white dark:text-gray-200 text-sm font-medium">
            @auth

                {{-- Dropdown خاص بالملف الشخصي والخروج --}}
                @if (auth()->user()->role === 'client')
                    <li class="relative ml-4" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-1 text-sm font-medium text-white hover:text-gray-300 focus:outline-none">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform ml-1" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg z-50 overflow-hidden border border-gray-200 dark:border-gray-700">
                            <a href="{{ route('client.profile.edit') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700">الملف الشخصي</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-red-400">
                                    تسجيل الخروج
                                </button>
                            </form>
                        </div>
                    </li>
                @endif

            @endauth

            {{-- <li>
                <a href="{{ route('home') }}" class="flex items-center gap-1 hover:text-gray-200">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    Home
                </a>
            </li> --}}

            @auth
                @if (auth()->user()->role === 'client')
                    @php
                        $favCount = auth()->user()->favorites()->count();
                    @endphp


                    <li class="relative">
                        <a href="{{ route('client.favorites.index') }}" class="flex items-center gap-1 hover:text-gray-200">
                            <i data-lucide="heart" class="w-4 h-4"></i> المفضلات
                            @if ($favCount > 0)
                                <span
                                    class="absolute -top-2 -right-3 bg-pink-600 text-white text-xs font-bold rounded-full px-1.5 py-0.5 leading-none">
                                    {{ $favCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endif
            @endauth
            <li>
                @guest
                    <a href="{{ route('client.categories.index') }}" class="flex items-center gap-1 hover:text-gray-200">
                        📚 التصنيفات
                    </a>
                @endguest

                @auth
                    @if (auth()->user()->role === 'client')
                        <a href="{{ route('client.categories.index') }}"
                            class="flex items-center gap-1 hover:text-gray-200">
                            📚 التصنيفات
                        </a>
                    @endif
                @endauth
            </li>


            @auth
                @if (auth()->user()->role === 'client')
                    {{-- <li>
                        <a href="{{ route('client.categories.index') }}"
                            class="flex items-center gap-1 hover:text-gray-200">
                            📚 التصنيفات
                        </a>
                    </li> --}}



                    <li class="relative">
                        <a href="{{ route('client.downloads') }}" class="flex items-center gap-1 hover:text-gray-200">
                            <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                            التحميلات
                            @php $downloadCount = auth()->user()->purchasedPdfs()->count(); @endphp
                            @if ($downloadCount > 0)
                                <span
                                    class="absolute -top-2 -right-3 bg-red-600 text-white text-xs font-bold rounded-full px-1.5 py-0.5 leading-none">
                                    {{ $downloadCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Dropdown خاص بالملف الشخصي والخروج --}}
                    {{-- <li class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-1 hover:text-gray-200">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            {{ Auth::user()->name }}
                            <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform ml-1" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg z-50 overflow-hidden">
                            <a href="{{ route('client.profile.edit') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">الملف الشخصي</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    تسجيل الخروج
                                </button>
                            </form>
                        </div>
                    </li> --}}
                @elseif (auth()->user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1 hover:text-gray-200">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            لوحة التحكم
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pdfs.index') }}" class="flex items-center gap-1 hover:text-gray-200">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                            إدارة ملفات PDF
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center gap-1 text-red-300 hover:text-red-100">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                @endif
            @endauth

            @guest
                <li>
                    <a href="{{ route('login') }}" class="flex items-center gap-1 hover:text-gray-200">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        Login
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="flex items-center gap-1 hover:text-gray-200">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Register
                    </a>
                </li>
            @endguest
            @guest
                <li>
                    <a href="{{ route('home') }}" class="flex items-center gap-1 hover:text-gray-200">
                        <i data-lucide="home" class="w-4 h-4"></i>
                        Home
                    </a>
                </li>
            @endguest

            @auth
                @if (auth()->user()->role === 'client')
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center gap-1 hover:text-gray-200">
                            <i data-lucide="home" class="w-4 h-4"></i>
                            Home
                        </a>
                    </li>
                @endif
            @endauth


            {{-- @guest
                <li class="relative w-64">
                    <form action="{{ route('search') }}" method="GET" class="flex items-center gap-2">
                        <input type="text" name="query" placeholder="🔍 ابحث عن كتاب..."
                            class="w-full px-4 py-2 rounded-lg text-sm text-gray-800 focus:outline-none" required
                            autocomplete="off">
                        <button type="submit"
                            class="bg-white text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-100">
                            بحث
                        </button>
                    </form>
                </li>
            @endguest

            @auth
                @if (auth()->user()->role === 'client')
                    <li class="relative w-64">
                        <form action="{{ route('search') }}" method="GET" class="flex items-center gap-2">
                            <input type="text" name="query" placeholder="🔍 ابحث عن كتاب..."
                                class="w-full px-4 py-2 rounded-lg text-sm text-gray-800 focus:outline-none" required
                                autocomplete="off">
                            <button type="submit"
                                class="bg-white text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-100">
                                بحث
                            </button>
                        </form>
                    </li>
                @endif
            @endauth --}}

            @guest
                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="text-white hover:text-gray-200 focus:outline-none">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>

                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50 p-2"
                        @click.away="open = false">
                        <form action="{{ route('search') }}" method="GET" class="flex items-center gap-2">
                            <input type="text" name="query" placeholder="ابحث عن كتاب..."
                                class="w-full px-4 py-2 rounded-lg text-sm text-gray-800 focus:outline-none" required
                                autocomplete="off">
                            <button type="submit"
                                class="bg-indigo-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                                بحث
                            </button>
                        </form>
                    </div>
                </li>
            @endguest

            @auth
                @if (auth()->user()->role === 'client')
                    <li class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-white hover:text-gray-200 focus:outline-none">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>

                        <div x-show="open" x-transition
                            class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50 p-2"
                            @click.away="open = false">
                            <form action="{{ route('search') }}" method="GET" class="flex items-center gap-2">
                                <input type="text" name="query" placeholder="ابحث عن كتاب..."
                                    class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm text-sm text-gray-700 placeholder-gray-400"
                                    required autocomplete="off">

                                <button type="submit"
                                    class="bg-indigo-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                                    بحث
                                </button>
                            </form>
                        </div>
                    </li>
                @endif
            @endauth


            <li>
                <button @click="darkMode = !darkMode"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white dark:bg-gray-700 hover:scale-105 transition-all relative"
                    :class="darkMode ? 'text-yellow-300' : 'text-gray-800'" aria-label="Toggle dark mode">
                    <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m8.66-12.66l-.71.71M4.05 4.05l.71.71M21 12h1M3 12H2m16.95 4.95l.71.71M4.05 19.95l.71-.71M12 5a7 7 0 000 14a7 7 0 000-14z" />
                    </svg>
                    <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path d="M17.293 13.293a8 8 0 01-10.586-10.586A8.001 8.001 0 1017.293 13.293z" />
                    </svg>
                </button>
            </li>

            <li>
                <form action="{{ route('language.switch') }}" method="POST" class="ml-4">
                    @csrf
                    <select name="locale" onchange="this.form.submit()"
                        class="bg-white border border-gray-300 text-gray-700 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>EN</option>
                        <option value="ar" {{ app()->getLocale() === 'ar' ? 'selected' : '' }}>AR</option>
                    </select>
                </form>
            </li>
        </ul>
        <x-logo />

    </div>
</nav>



<style>
    body {
        padding-top: 4.5rem;
    }

    .autocomplete-box {
        background: white;
        position: absolute;
        z-index: 50;
        width: 100%;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .autocomplete-item {
        padding: 0.5rem 1rem;
        cursor: pointer;
        color: #333;
    }

    .autocomplete-item:hover {
        background: #f0f0f0;
    }
</style>

<script>
    // Autocomplete
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.querySelector('input[name="query"]');
        if (!input) return;

        const form = input.closest('form');
        const suggestionBox = document.createElement('div');
        suggestionBox.classList.add('autocomplete-box');
        suggestionBox.style.top = '100%';
        suggestionBox.style.left = '0';
        suggestionBox.style.right = '0';
        input.parentNode.style.position = 'relative';
        input.parentNode.appendChild(suggestionBox);

        let timeout = null;

        input.addEventListener('input', function() {
            const query = this.value;
            clearTimeout(timeout);

            if (query.length < 2) {
                suggestionBox.innerHTML = '';
                return;
            }

            timeout = setTimeout(() => {
                fetch(`{{ route('search') }}?query=${query}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        suggestionBox.innerHTML = '';
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.classList.add('autocomplete-item');
                            div.textContent = item;
                            div.addEventListener('click', () => {
                                input.value = item;
                                form.submit();
                            });
                            suggestionBox.appendChild(div);
                        });
                    });
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (!form.contains(e.target)) {
                suggestionBox.innerHTML = '';
            }
        });
    });

    // 🌙 Dark Mode Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const html = document.documentElement;
        const storedTheme = localStorage.getItem('theme');

        // ✅ الوضع النهاري هو الافتراضي
        if (storedTheme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        const toggleBtn = document.getElementById('theme-toggle');
        toggleBtn?.addEventListener('click', function() {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    });
</script>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
