<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Receipt - {{ $sale->receipt_number }}
            </h2>
            <button onclick="window.print()"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Print Receipt
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8" id="receipt">

                    <!-- Header -->
                    <div class="text-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Woods Pharmaceuticals</h1>
                        <p class="text-gray-500 text-sm">Nairobi, Kenya</p>
                        <p class="text-gray-500 text-sm">Tel: +254 700 000 000</p>
                        <div class="border-t border-gray-300 mt-3 pt-3">
                            <p class="font-bold text-gray-700 dark:text-gray-300">RECEIPT</p>
                        </div>
                    </div>

                    <!-- Receipt Info -->
                    <div class="grid grid-cols-2 gap-2 text-sm text-gray-700 dark:text-gray-300 mb-6">
                        <div>
                            <p><span class="font-medium">Receipt No:</span> {{ $sale->receipt_number }}</p>
                            <p><span class="font-medium">Date:</span> {{ $sale->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="text-right">
                            <p><span class="font-medium">Served By:</span> {{ $sale->user->name }}</p>
                            <p><span class="font-medium">Customer:</span> {{ $sale->customer_name ?? 'Walk-in' }}</p>
                        </div>
                    </div>

                    <!-- Items -->
                    <table class="w-full text-sm mb-6">
                        <thead class="border-t border-b border-gray-300">
                            <tr>
                                <th class="py-2 text-left text-gray-700 dark:text-gray-300">Item</th>
                                <th class="py-2 text-center text-gray-700 dark:text-gray-300">Qty</th>
                                <th class="py-2 text-right text-gray-700 dark:text-gray-300">Unit Price</th>
                                <th class="py-2 text-right text-gray-700 dark:text-gray-300">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->items as $item)
                                <tr class="border-b border-gray-200">
                                    <td class="py-2 text-gray-700 dark:text-gray-300">{{ $item->medicine->name }}</td>
                                    <td class="py-2 text-center text-gray-700 dark:text-gray-300">{{ $item->quantity }}</td>
                                    <td class="py-2 text-right text-gray-700 dark:text-gray-300">KES {{ number_format($item->unit_price, 2) }}</td>
                                    <td class="py-2 text-right text-gray-700 dark:text-gray-300">KES {{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Totals -->
                    <div class="border-t border-gray-300 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between font-bold text-lg text-gray-800 dark:text-gray-200">
                            <span>Total</span>
                            <span>KES {{ number_format($sale->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700 dark:text-gray-300">
                            <span>Payment Method</span>
                            <span class="capitalize">{{ $sale->payment_method }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700 dark:text-gray-300">
                            <span>Amount Paid</span>
                            <span>KES {{ number_format($sale->amount_paid, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700 dark:text-gray-300">
                            <span>Change</span>
                            <span>KES {{ number_format($sale->change_given, 2) }}</span>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-8 text-sm text-gray-500">
                        <p>Thank you for your purchase!</p>
                        <p>Please keep this receipt for your records.</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex gap-4">
                <a href="{{ route('sales.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                    New Sale
                </a>
                <a href="{{ route('sales.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                    All Sales
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
