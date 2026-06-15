<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Purchase Orders
            </h2>
            <a href="{{ route('purchases.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + New Purchase Order
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

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">Ref No.</th>
                                <th class="px-4 py-3">Supplier</th>
                                <th class="px-4 py-3">Order Date</th>
                                <th class="px-4 py-3">Expected Date</th>
                                <th class="px-4 py-3">Total (KES)</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $purchase)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-medium">{{ $purchase->reference_number }}</td>
                                    <td class="px-4 py-3">{{ $purchase->supplier->name }}</td>
                                    <td class="px-4 py-3">{{ $purchase->order_date->format('d M Y') }}</td>
                                    <td class="px-4 py-3">{{ $purchase->expected_date ? $purchase->expected_date->format('d M Y') : '-' }}</td>
                                    <td class="px-4 py-3">{{ number_format($purchase->total_amount, 2) }}</td>
                                    <td class="px-4 py-3">
                                        @if($purchase->status === 'received')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Received</span>
                                        @elseif($purchase->status === 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Pending</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Cancelled</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <a href="{{ route('purchases.show', $purchase) }}"
                                           class="text-blue-600 hover:underline">View</a>
                                        @if($purchase->status === 'pending')
                                            <form action="{{ route('purchases.receive', $purchase) }}" method="POST"
                                                  onsubmit="return confirm('Mark as received and update stock?')">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:underline">Receive</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('purchases.destroy', $purchase) }}" method="POST"
                                              onsubmit="return confirm('Delete this purchase order?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                        No purchase orders found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>