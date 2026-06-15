<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pharmacist Dashboard
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
                <div class="bg-orange-50 dark:bg-gray-800 border border-orange-200 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-orange-600 font-medium">Low Stock</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $low_stock }}</p>
                </div>
                <div class="bg-yellow-50 dark:bg-gray-800 border border-yellow-200 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-yellow-600 font-medium">Expiring Soon</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $expiring_soon }}</p>
                </div>
                <div class="bg-red-50 dark:bg-gray-800 border border-red-200 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-red-600 font-medium">Expired</p>
                    <p class="text-3xl font-bold text-red-600">{{ $expired }}</p>
                </div>
            </div>

            <!-- Low Stock Medicines -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Low Stock Medicines</h3>
                    <a href="{{ route('medicines.index') }}" class="text-blue-600 text-sm hover:underline">View all medicines</a>
                </div>
                <table class="w-full text-sm text-gray-700 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-left">Medicine</th>
                            <th class="px-3 py-2 text-left">Category</th>
                            <th class="px-3 py-2 text-center">Quantity</th>
                            <th class="px-3 py-2 text-center">Reorder Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($low_stock_medicines as $medicine)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-3 py-2 font-medium">{{ $medicine->name }}</td>
                                <td class="px-3 py-2">{{ $medicine->category }}</td>
                                <td class="px-3 py-2 text-center text-red-600 font-bold">{{ $medicine->quantity }}</td>
                                <td class="px-3 py-2 text-center">{{ $medicine->reorder_level }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-gray-500">No low stock medicines.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>