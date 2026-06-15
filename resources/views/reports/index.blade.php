<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Reports
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <a href="{{ route('reports.sales') }}"
                   class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-blue-600 text-4xl mb-4">📊</div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Sales Report</h3>
                    <p class="text-gray-500 text-sm mt-1">View sales transactions, revenue, and payment methods by date range.</p>
                </a>

                <a href="{{ route('reports.inventory') }}"
                   class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-green-600 text-4xl mb-4">📦</div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Inventory Report</h3>
                    <p class="text-gray-500 text-sm mt-1">View full stock levels, low stock alerts, and expired medicines.</p>
                </a>

                <a href="{{ route('reports.expiry') }}"
                   class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-red-600 text-4xl mb-4">⚠️</div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Expiry Report</h3>
                    <p class="text-gray-500 text-sm mt-1">Monitor medicines nearing expiry or already expired.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>