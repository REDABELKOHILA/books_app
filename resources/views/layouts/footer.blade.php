@auth
    @if (auth()->user()->role === 'client')
        <footer
            class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white dark:from-gray-800 dark:to-gray-900 dark:text-gray-100 mt-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Newsletter Form -->
                <div>
                    <h2 class="text-xl font-semibold mb-3">📬 اشترك في النشرة الإخبارية</h2>
                    <p class="mb-4 text-sm text-purple-100 dark:text-gray-300">توصل بآخر الكتب والعروض مباشرة في بريدك
                        الإلكتروني.</p>
                    <form action="#" method="POST" class="flex flex-col sm:flex-row items-center gap-2">
                        <input type="email" name="email" required placeholder="أدخل بريدك الإلكتروني"
                            class="px-4 py-2 rounded-lg text-gray-800 dark:text-white dark:bg-gray-700 focus:outline-none w-full sm:w-auto flex-grow">
                        <button type="submit"
                            class="bg-white text-purple-700 hover:bg-gray-100 dark:bg-gray-100 dark:text-purple-800 dark:hover:bg-gray-300 font-semibold px-4 py-2 rounded-lg transition">
                            اشترك
                        </button>
                    </form>
                </div>

                <!-- Return to Top + Links -->
                <div class="flex flex-col justify-between">
                    <div class="flex justify-center md:justify-end mb-4 md:mb-0">
                        <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"
                            class="bg-white text-indigo-700 font-semibold px-4 py-2 rounded-full shadow hover:bg-gray-100 dark:bg-gray-100 dark:text-indigo-800 dark:hover:bg-gray-300 transition">
                            🔝 العودة إلى الأعلى
                        </button>
                    </div>
                    <p class="text-sm text-center md:text-end text-purple-100 dark:text-gray-400">
                        © {{ date('Y') }} موقع الكتب الرقمي - جميع الحقوق محفوظة.
                    </p>
                </div>
            </div>
        </footer>
    @endif
@endauth
