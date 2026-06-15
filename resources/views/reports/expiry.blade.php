<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Expiry Report
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Expiring Within 30 Days</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $expiring_soon->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Already Expired</p>
                    <p class="text-3xl font-bold text-red-600">{{ $expired->count() }}</p>
                </div>
            </div>

            <!-- Expiring Soon -->
            @if($expiring_soon->count() > 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-yellow-600 mb-4">⚠️ Expiring Within 30 Days</h3>
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-yellow-50 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Medicine</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Quantity</th>
                                <th class="px-4 py-3">Batch No.</th>
                                <th class="px-4 py-3">Expiry Date</th>
                                <th class="px-4 py-3">Days Left</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expiring_soon as $index => $medicine)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $medicine->name }}</td>
                                    <td class="px-4 py-3">{{ $medicine->category }}</td>
                                    <td class="px-4 py-3">{{ $medicine->quantity }}</td>
                                    <td class="px-4 py-3">{{ $medicine->batch_number ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $medicine->expiry_date->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-yellow-600 font-bold">
                                        {{ now()->diffInDays($medicine->expiry_date) }} days
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Expired -->
            @if($expired->count() > 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-red-600 mb-4">❌ Expired Medicines</h3>
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-red-50 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Medicine</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Quantity</th>
                                <th class="px-4 py-3">Batch No.</th>
                                <th class="px-4 py-3">Expiry Date</th>
                                <th class="px-4 py-3">Expired</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expired as $index => $medicine)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $medicine->name }}</td>
                                    <td class="px-4 py-3">{{ $medicine->category }}</td>
                                    <td class="px-4 py-3">{{ $medicine->quantity }}</td>
                                    <td class="px-4 py-3">{{ $medicine->batch_number ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $medicine->expiry_date->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-red-600 font-bold">
                                        {{ $medicine->expiry_date->diffInDays(now()) }} days ago
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($expiring_soon->count() === 0 && $expired->count() === 0)
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    ✅ No expiry issues found. All medicines are within their expiry dates.
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('reports.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                    Back to Reports
                </a>
            </div>
        </div>
    </div>
</x-app-layout>