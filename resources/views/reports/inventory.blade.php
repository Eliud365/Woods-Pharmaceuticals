<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Inventory Report
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Medicines</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $medicines->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Low Stock</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $low_stock->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Expiring Soon</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $expiring_soon->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Expired</p>
                    <p class="text-3xl font-bold text-red-600">{{ $expired->count() }}</p>
                </div>
            </div>

            <!-- Full Inventory Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Full Inventory</h3>
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Quantity</th>
                                <th class="px-4 py-3">Reorder Level</th>
                                <th class="px-4 py-3">Buying Price</th>
                                <th class="px-4 py-3">Selling Price</th>
                                <th class="px-4 py-3">Expiry Date</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicines as $medicine)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $medicine->name }}</td>
                                    <td class="px-4 py-3">{{ $medicine->category }}</td>
                                    <td class="px-4 py-3 {{ $medicine->isLowStock() ? 'text-red-600 font-bold' : '' }}">
                                        {{ $medicine->quantity }}
                                    </td>
                                    <td class="px-4 py-3">{{ $medicine->reorder_level }}</td>
                                    <td class="px-4 py-3">KES {{ number_format($medicine->buying_price, 2) }}</td>
                                    <td class="px-4 py-3">KES {{ number_format($medicine->selling_price, 2) }}</td>
                                    <td class="px-4 py-3">{{ $medicine->expiry_date->format('d M Y') }}</td>
                                    <td class="px-4 py-3">
                                        @if($medicine->isExpired())
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Expired</span>
                                        @elseif($medicine->isExpiringSoon())
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Expiring Soon</span>
                                        @elseif($medicine->isLowStock())
                                            <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded text-xs">Low Stock</span>
                                        @else
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">OK</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-6 text-center text-gray-500">
                                        No medicines found.
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