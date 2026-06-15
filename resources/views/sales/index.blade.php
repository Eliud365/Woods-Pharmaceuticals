<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Sales Transactions
            </h2>
            <a href="{{ route('sales.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + New Sale
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">Receipt No.</th>
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Served By</th>
                                <th class="px-4 py-3">Payment</th>
                                <th class="px-4 py-3">Total (KES)</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $sale)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-medium">{{ $sale->receipt_number }}</td>
                                    <td class="px-4 py-3">{{ $sale->customer_name ?? 'Walk-in' }}</td>
                                    <td class="px-4 py-3">{{ $sale->user->name }}</td>
                                    <td class="px-4 py-3 capitalize">{{ $sale->payment_method }}</td>
                                    <td class="px-4 py-3">{{ number_format($sale->total_amount, 2) }}</td>
                                    <td class="px-4 py-3">{{ $sale->created_at->format('d M Y, h:i A') }}</td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <a href="{{ route('sales.receipt', $sale->id) }}"
                                           class="text-blue-600 hover:underline">Receipt</a>
                                        <form action="{{ route('sales.destroy', $sale) }}" method="POST"
                                              onsubmit="return confirm('Delete this sale?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                        No sales recorded yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>