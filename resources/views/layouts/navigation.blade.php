<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">PDF Store</a>

        @auth
            <div class="flex gap-4 items-center">
                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline">Log Out</button>
                </form>
            </div>
            <nav class="space-x-4">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600">🏠 الرئيسية</a>

                @if(auth()->user() && auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-indigo-600">🛠️ لوحة التحكم</a>
                @endif
            </nav>
        @else
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        @endauth
    </div>
</nav>
