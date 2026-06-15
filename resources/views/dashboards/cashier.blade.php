<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cashier Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">My Sales Today</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $today_count }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">My Revenue Today</p>
                    <p class="text-3xl font-bold text-green-600">KES {{ number_format($today_sales, 2) }}</p>
                </div>
            </div>

            <!-- Quick Action -->
            <div class="mb-6">
                <a href="{{ route('sales.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded text-lg">
                    + New Sale
                </a>
            </div>

            <!-- Recent Sales -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">My Recent Sales</h3>
                    <a href="{{ route('sales.index') }}" class="text-blue-600 text-sm hover:underline">View all</a>
                </div>
                <table class="w-full text-sm text-gray-700 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-left">Receipt No.</th>
                            <th class="px-3 py-2 text-left">Customer</th>
                            <th class="px-3 py-2 text-center">Items</th>
                            <th class="px-3 py-2 text-right">Total</th>
                            <th class="px-3 py-2 text-right">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_sales as $sale)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-3 py-2 font-medium">
                                    <a href="{{ route('sales.receipt', $sale->id) }}" class="text-blue-600 hover:underline">
                                        {{ $sale->receipt_number }}
                                    </a>
                                </td>
                                <td class="px-3 py-2">{{ $sale->customer_name ?? 'Walk-in' }}</td>
                                <td class="px-3 py-2 text-center">{{ $sale->items->count() }}</td>
                                <td class="px-3 py-2 text-right">KES {{ number_format($sale->total_amount, 2) }}</td>
                                <td class="px-3 py-2 text-right">{{ $sale->created_at->format('d M, h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3 py-4 text-center text-gray-500">No sales yet today.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>