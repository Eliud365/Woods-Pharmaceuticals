<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Purchase Order: {{ $purchase->reference_number }}
            </h2>
            @if($purchase->status === 'pending')
                <form action="{{ route('purchases.receive', $purchase) }}" method="POST"
                      onsubmit="return confirm('Mark as received and update stock?')">
                    @csrf
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Mark as Received
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">

                    <!-- Order Info -->
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-700 dark:text-gray-300 mb-8">
                        <div class="space-y-2">
                            <p><span class="font-medium">Reference No:</span> {{ $purchase->reference_number }}</p>
                            <p><span class="font-medium">Supplier:</span> {{ $purchase->supplier->name }}</p>
                            <p><span class="font-medium">Ordered By:</span> {{ $purchase->user->name }}</p>
                        </div>
                        <div class="space-y-2">
                            <p><span class="font-medium">Order Date:</span> {{ $purchase->order_date->format('d M Y') }}</p>
                            <p><span class="font-medium">Expected Date:</span> {{ $purchase->expected_date ? $purchase->expected_date->format('d M Y') : '-' }}</p>
                            <p><span class="font-medium">Received Date:</span> {{ $purchase->received_date ? $purchase->received_date->format('d M Y') : '-' }}</p>
                            <p>
                                <span class="font-medium">Status:</span>
                                @if($purchase->status === 'received')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Received</span>
                                @elseif($purchase->status === 'pending')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Pending</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Cancelled</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Items -->
                    <table class="w-full text-sm mb-6">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">#</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Medicine</th>
                                <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-300">Quantity</th>
                                <th class="px-4 py-2 text-right text-gray-700 dark:text-gray-300">Unit Price</th>
                                <th class="px-4 py-2 text-right text-gray-700 dark:text-gray-300">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase->items as $index => $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $item->medicine->name }}</td>
                                    <td class="px-4 py-2 text-center text-gray-700 dark:text-gray-300">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2 text-right text-gray-700 dark:text-gray-300">KES {{ number_format($item->unit_price, 2) }}</td>
                                    <td class="px-4 py-2 text-right text-gray-700 dark:text-gray-300">KES {{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-gray-300">
                                <td colspan="4" class="px-4 py-2 text-right font-bold text-gray-800 dark:text-gray-200">Total</td>
                                <td class="px-4 py-2 text-right font-bold text-gray-800 dark:text-gray-200">KES {{ number_format($purchase->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    @if($purchase->notes)
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            <span class="font-medium">Notes:</span> {{ $purchase->notes }}
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('purchases.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                            Back to Purchase Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>