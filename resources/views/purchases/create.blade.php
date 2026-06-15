<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            New Purchase Order
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

                    <form action="{{ route('purchases.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier *</label>
                                <select name="supplier_id"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                                    <option value="">-- Select Supplier --</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order Date *</label>
                                <input type="date" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expected Delivery Date</label>
                                <input type="date" name="expected_date" value="{{ old('expected_date') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <input type="text" name="notes" value="{{ old('notes') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>
                        </div>

                        <!-- Medicines -->
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Medicines</h3>
                                <button type="button" onclick="addRow()"
                                    class="bg-green-600 hover:bg-green-700 text-white text-sm py-1 px-3 rounded">
                                    + Add Item
                                </button>
                            </div>

                            <table class="w-full text-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Medicine</th>
                                        <th class="px-3 py-2 text-left">Quantity</th>
                                        <th class="px-3 py-2 text-left">Unit Price (KES)</th>
                                        <th class="px-3 py-2 text-left">Subtotal</th>
                                        <th class="px-3 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody id="medicineRows"></tbody>
                            </table>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-end mb-6">
                            <div class="text-lg font-bold text-gray-800 dark:text-gray-200">
                                Total: KES <span id="totalDisplay">0.00</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Create Purchase Order
                            </button>
                            <a href="{{ route('purchases.index') }}"
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

        function addRow() {
            const tbody = document.getElementById('medicineRows');
            const row = document.createElement('tr');
            row.id = `row_${rowIndex}`;
            row.className = 'border-b dark:border-gray-700';
            row.innerHTML = `
                <td class="px-3 py-2">
                    <select name="medicines[${rowIndex}][id]"
                        class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm text-sm">
                        <option value="">-- Select Medicine --</option>
                        ${medicines.map(m => `<option value="${m.id}">${m.name}</option>`).join('')}
                    </select>
                </td>
                <td class="px-3 py-2">
                    <input type="number" name="medicines[${rowIndex}][quantity]" min="1" value="1"
                        oninput="updateSubtotal(${rowIndex})"
                        class="w-20 rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm text-sm">
                </td>
                <td class="px-3 py-2">
                    <input type="number" step="0.01" name="medicines[${rowIndex}][unit_price]" value="0.00"
                        oninput="updateSubtotal(${rowIndex})"
                        class="w-28 rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm text-sm">
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

        function updateSubtotal(index) {
            const qty = parseFloat(document.querySelector(`input[name="medicines[${index}][quantity]"]`).value) || 0;
            const price = parseFloat(document.querySelector(`input[name="medicines[${index}][unit_price]"]`).value) || 0;
            const subtotal = qty * price;
            document.getElementById(`subtotal_${index}`).value = subtotal.toFixed(2);
            updateTotal();
        }

        function updateTotal() {
            let sum = 0;
            document.querySelectorAll('[id^="subtotal_"]').forEach(el => {
                sum += parseFloat(el.value) || 0;
            });
            document.getElementById('totalDisplay').textContent = sum.toFixed(2);
        }

        function removeRow(index) {
            document.getElementById(`row_${index}`).remove();
            updateTotal();
        }

        addRow();
    </script>
</x-app-layout>