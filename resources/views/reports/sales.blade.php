<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sales Report
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filter -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('reports.sales') }}" class="flex gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">From</label>
                        <input type="date" name="from" value="{{ $from }}"
                            class="mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">To</label>
                        <input type="date" name="to" value="{{ $to }}"
                            class="mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Filter
                    </button>
                    <a href="{{ route('reports.sales') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Reset
                    </a>
                </form>
            </div>

            <!-- Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Sales</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $total_sales }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-3xl font-bold text-green-600">KES {{ number_format($total_revenue, 2) }}</p>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">Receipt No.</th>
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Served By</th>
                                <th class="px-4 py-3">Payment</th>
                                <th class="px-4 py-3">Items</th>
                                <th class="px-4 py-3">Total (KES)</th>
                                <th class="px-4 py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $sale)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-medium">{{ $sale->receipt_number }}</td>
                                    <td class="px-4 py-3">{{ $sale->customer_name ?? 'Walk-in' }}</td>
                                    <td class="px-4 py-3">{{ $sale->user->name }}</td>
                                    <td class="px-4 py-3 capitalize">{{ $sale->payment_method }}</td>
                                    <td class="px-4 py-3">{{ $sale->items->count() }}</td>
                                    <td class="px-4 py-3">{{ number_format($sale->total_amount, 2) }}</td>
                                    <td class="px-4 py-3">{{ $sale->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                        No sales found for the selected period.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('reports.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                    Back to Reports
                </a>
            </div>
        </div>
    </div>
</x-app-layout>