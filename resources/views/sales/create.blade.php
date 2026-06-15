<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            New Sale
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
                        @csrf

                        <!-- Customer Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer Name (Optional)</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                                    placeholder="Walk-in customer"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method *</label>
                                <select name="payment_method"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                                    <option value="cash">Cash</option>
                                    <option value="mpesa">M-Pesa</option>
                                    <option value="insurance">Insurance</option>
                                </select>
                            </div>
                        </div>

                        <!-- Medicines -->
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Medicines</h3>
                                <button type="button" onclick="addMedicineRow()"
                                    class="bg-green-600 hover:bg-green-700 text-white text-sm py-1 px-3 rounded">
                                    + Add Item
                                </button>
                            </div>

                            <table class="w-full text-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Medicine</th>
                                        <th class="px-3 py-2 text-left">Unit Price</th>
                                        <th class="px-3 py-2 text-left">Quantity</th>
                                        <th class="px-3 py-2 text-left">Subtotal</th>
                                        <th class="px-3 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody id="medicineRows">
                                    <!-- rows added dynamically -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Totals -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea name="notes" rows="2"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm"></textarea>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between text-lg font-bold text-gray-800 dark:text-gray-200">
                                    <span>Total:</span>
                                    <span>KES <span id="totalDisplay">0.00</span></span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount Paid (KES) *</label>
                                    <input type="number" step="0.01" name="amount_paid" id="amountPaid"
                                        oninput="calculateChange()"
                                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                                </div>
                                <div class="flex justify-between text-md text-gray-700 dark:text-gray-300">
                                    <span>Change:</span>
                                    <span>KES <span id="changeDisplay">0.00</span></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-4">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Complete Sale
                            </button>
                            <a href="{{ route('sales.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const medicines = @json($medicines);
        let rowIndex = 0;
        let total = 0;

        function addMedicineRow() {
            const tbody = document.getElementById('medicineRows');
            const row = document.createElement('tr');
            row.id = `row_${rowIndex}`;
            row.className = 'border-b dark:border-gray-700';
            row.innerHTML = `
                <td class="px-3 py-2">
                    <select name="medicines[${rowIndex}][id]" onchange="updatePrice(${rowIndex})"
                        class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm text-sm">
                        <option value="">-- Select Medicine --</option>
                        ${medicines.map(m => `<option value="${m.id}" data-price="${m.selling_price}">${m.name} (${m.quantity} left)</option>`).join('')}
                    </select>
                </td>
                <td class="px-3 py-2">
                    <input type="text" id="price_${rowIndex}" readonly value="0.00"
                        class="w-24 rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm text-sm bg-gray-50">
                </td>
                <td class="px-3 py-2">
                    <input type="number" name="medicines[${rowIndex}][quantity]" min="1" value="1"
                        oninput="updateSubtotal(${rowIndex})"
                        class="w-20 rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm text-sm">
                </td>
                <td class="px-3 py-2">
                    <input type="text" id="subtotal_${rowIndex}" readonly value="0.00"
                        class="w-24 rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm text-sm bg-gray-50">
                </td>
                <td class="px-3 py-2">
                    <button type="button" onclick="removeRow(${rowIndex})"
                        class="text-red-600 hover:text-red-800 text-sm">Remove</button>
                </td>
            `;
            tbody.appendChild(row);
            rowIndex++;
        }

        function updatePrice(index) {
            const select = document.querySelector(`select[name="medicines[${index}][id]"]`);
            const option = select.options[select.selectedIndex];
            const price = parseFloat(option.dataset.price) || 0;
            document.getElementById(`price_${index}`).value = price.toFixed(2);
            updateSubtotal(index);
        }

        function updateSubtotal(index) {
            const price = parseFloat(document.getElementById(`price_${index}`).value) || 0;
            const qty = parseInt(document.querySelector(`input[name="medicines[${index}][quantity]"]`).value) || 0;
            const subtotal = price * qty;
            document.getElementById(`subtotal_${index}`).value = subtotal.toFixed(2);
            updateTotal();
        }

        function updateTotal() {
            let sum = 0;
            document.querySelectorAll('[id^="subtotal_"]').forEach(el => {
                sum += parseFloat(el.value) || 0;
            });
            total = sum;
            document.getElementById('totalDisplay').textContent = sum.toFixed(2);
            calculateChange();
        }

        function calculateChange() {
            const paid = parseFloat(document.getElementById('amountPaid').value) || 0;
            const change = paid - total;
            document.getElementById('changeDisplay').textContent = change.toFixed(2);
        }

        function removeRow(index) {
            document.getElementById(`row_${index}`).remove();
            updateTotal();
        }

        // Add first row automatically
        addMedicineRow();
    </script>
</x-app-layout>