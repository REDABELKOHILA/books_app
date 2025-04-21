{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">📊 لوحة تحكم المشرف</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">عدد المستخدمين</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $usersCount }}</p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">عدد ملفات PDF</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $pdfsCount }}</p>
                </div>
            </div>

            <!-- Latest Users -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">🧑‍💻 المستخدمين الجدد (آخر ساعة)</h3>
                @if ($recentUsers->count())
                    <ul class="space-y-2">
                        @foreach ($recentUsers as $user)
                            <li class="text-gray-800 border-b pb-2">
                                {{ $user->name }} - <span
                                    class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">لا يوجد مستخدمون جدد في آخر ساعة.</p>
                @endif
            </div>
            <!-- عدد الزوار -->
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold text-gray-700">زوار آخر 24 ساعة</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $visitorsCount }}</p>
            </div>


            <!-- Latest PDFs -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">📄 ملفات PDF المضافة حديثاً (آخر ساعة)</h3>
                @if ($recentPDFs->count())
                    <ul class="space-y-2">
                        @foreach ($recentPDFs as $pdf)
                            <li class="text-gray-800 border-b pb-2">
                                {{ $pdf->title }} - <span
                                    class="text-sm text-gray-500">{{ $pdf->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">لا توجد ملفات PDF جديدة في آخر ساعة.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout> --}}




<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-extrabold text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6a2 2 0 012-2h6"></path>
            </svg>
            لوحة تحكم المشرف
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- الإحصائيات -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">📈 عدد المستخدمين خلال آخر 7 أيام</h3>
                    <canvas id="usersChart" height="100"></canvas>
                </div>
                {{-- <pre>{{ var_dump($downloadsStats) }}</pre> --}}

                <div class="bg-purple-50 dark:bg-purple-900 p-6 rounded-2xl shadow-md">
                    <h3 class="text-lg font-semibold text-purple-700 dark:text-purple-200 mb-4">📥 عدد التحميلات الإجمالي خلال آخر 30 يوم</h3>
                    <canvas id="totalDownloadsChart" height="100"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-indigo-50 dark:bg-indigo-900 p-6 rounded-2xl shadow-md">
                    <h3 class="text-sm font-medium text-indigo-700 dark:text-indigo-200 mb-1">👤 عدد المستخدمين</h3>
                    <p class="text-4xl font-bold text-indigo-900 dark:text-indigo-100">{{ $usersCount }}</p>
                </div>

                @if ($mostDownloadedPDF)
                    <div class="bg-red-50 dark:bg-red-900 p-6 rounded-2xl shadow-md">
                        <h3 class="text-sm font-medium text-red-700 dark:text-red-200 mb-1">🔥 أكثر ملف تحميلاً</h3>
                        <p class="text-lg font-semibold text-red-900 dark:text-red-100 mb-1">{{ $mostDownloadedPDF->title }}</p>
                        <p class="text-sm text-red-600 dark:text-red-300">عدد التحميلات: {{ $mostDownloadedPDF->downloads_count }}</p>
                    </div>
                @endif

                <div class="bg-green-50 dark:bg-green-900 p-6 rounded-2xl shadow-md">
                    <h3 class="text-sm font-medium text-green-700 dark:text-green-200 mb-1">📄 عدد ملفات PDF</h3>
                    <p class="text-4xl font-bold text-green-900 dark:text-green-100">{{ $pdfsCount }}</p>
                </div>

                <div class="bg-yellow-50 dark:bg-yellow-900 p-6 rounded-2xl shadow-md">
                    <h3 class="text-sm font-medium text-yellow-700 dark:text-yellow-200 mb-1">👁️‍🗨️ زوار آخر 24 ساعة</h3>
                    <p class="text-4xl font-bold text-yellow-900 dark:text-yellow-100">{{ $visitorsCount }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">🧑‍💻 المستخدمون الجدد (آخر ساعة)</h3>
                @if ($recentUsers->count())
                    <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($recentUsers as $user)
                            <li class="py-2 flex justify-between">
                                <span class="text-gray-800 dark:text-gray-100 font-medium">{{ $user->name }}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 dark:text-gray-400">لا يوجد مستخدمون جدد.</p>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">📁 ملفات PDF الجديدة (آخر ساعة)</h3>
                @if ($recentPDFs->count())
                    <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($recentPDFs as $pdf)
                            <li class="py-2 flex justify-between">
                                <span class="text-gray-800 dark:text-gray-100 font-medium">{{ $pdf->title }}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $pdf->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 dark:text-gray-400">لا توجد ملفات جديدة.</p>
                @endif
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const usersChartCtx = document.getElementById('usersChart').getContext('2d');
        const usersChart = new Chart(usersChartCtx, {
            type: 'line',
            data: {
                labels: @json($userStats['labels']),
                datasets: [{
                    label: 'عدد المستخدمين',
                    data: @json($userStats['data']),
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        const downloadsChartCtx = document.getElementById('totalDownloadsChart').getContext('2d');
        const downloadsChart = new Chart(downloadsChartCtx, {
            type: 'line',
            data: {
                labels: @json($downloadsStats['labels']),
                datasets: [{
                    label: 'عدد التحميلات',
                    data: @json($downloadsStats['data']),
                    // backgroundColor: 'rgba(139, 92, 246, 0.5)',
                    // borderColor: 'rgba(139, 92, 246, 1)',
                    // borderWidth: 1
                    // backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    // borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    </script>


</x-app-layout>
