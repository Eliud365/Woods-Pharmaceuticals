<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Medicines</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $total_medicines }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Suppliers</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $total_suppliers }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Today's Revenue</p>
                    <p class="text-3xl font-bold text-green-600">KES {{ number_format($today_sales, 2) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Monthly Revenue</p>
                    <p class="text-3xl font-bold text-green-600">KES {{ number_format($monthly_revenue, 2) }}</p>
                </div>
            </div>

            <!-- Alert Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-orange-50 dark:bg-gray-800 border border-orange-200 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-orange-600 font-medium">Low Stock Alerts</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $low_stock }}</p>
                    <a href="{{ route('reports.inventory') }}" class="text-sm text-orange-500 hover:underline">View details →</a>
                </div>
                <div class="bg-yellow-50 dark:bg-gray-800 border border-yellow-200 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-yellow-600 font-medium">Expiring Soon</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $expiring_soon }}</p>
                    <a href="{{ route('reports.expiry') }}" class="text-sm text-yellow-500 hover:underline">View details →</a>
                </div>
                <div class="bg-red-50 dark:bg-gray-800 border border-red-200 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-red-600 font-medium">Expired Medicines</p>
                    <p class="text-3xl font-bold text-red-600">{{ $expired }}</p>
                    <a href="{{ route('reports.expiry') }}" class="text-sm text-red-500 hover:underline">View details →</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Recent Sales -->
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Recent Sales</h3>
                        <a href="{{ route('sales.index') }}" class="text-blue-600 text-sm hover:underline">View all</a>
                    </div>
                    <table class="w-full text-sm text-gray-700 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-3 py-2 text-left">Receipt</th>
                                <th class="px-3 py-2 text-left">Served By</th>
                                <th class="px-3 py-2 text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_sales as $sale)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-3 py-2">{{ $sale->receipt_number }}</td>
                                    <td class="px-3 py-2">{{ $sale->user->name }}</td>
                                    <td class="px-3 py-2 text-right">KES {{ number_format($sale->total_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-3 py-4 text-center text-gray-500">No sales yet today.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Low Stock Medicines -->
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Low Stock Medicines</h3>
                        <a href="{{ route('medicines.index') }}" class="text-blue-600 text-sm hover:underline">View all</a>
                    </div>
                    <table class="w-full text-sm text-gray-700 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-3 py-2 text-left">Medicine</th>
                                <th class="px-3 py-2 text-center">Quantity</th>
                                <th class="px-3 py-2 text-center">Reorder Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($low_stock_medicines as $medicine)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-3 py-2">{{ $medicine->name }}</td>
                                    <td class="px-3 py-2 text-center text-red-600 font-bold">{{ $medicine->quantity }}</td>
                                    <td class="px-3 py-2 text-center">{{ $medicine->reorder_level }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-3 py-4 text-center text-gray-500">No low stock medicines.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>