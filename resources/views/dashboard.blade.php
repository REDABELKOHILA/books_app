<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('📁 لوحة المستخدم') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-2xl overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-lg leading-relaxed">
                    👋 {{ __('مرحبا بك، عزيزي المستخدم!') }}<br>
                    يمكنك الوصول إلى الملفات الخاصة بك، مراجعة عمليات الشراء، وتحميل ما تريده بسهولة من هنا.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
