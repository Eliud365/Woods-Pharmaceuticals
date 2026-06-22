<x-app-layout>
    <x-slot name="header">New Purchase Order</x-slot>

    <div style="max-width:900px;">
        @if($errors->any())
            <div style="background:#fee2e2;border:1px solid #fecaca;color:#b91c1c;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                <ul style="margin:0;padding-left:16px;">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf
            <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;margin-bottom:16px;">
                <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;">
                    <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Order Details</h3>
                </div>
                <div style="padding:20px;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Supplier *</label>
                            <select name="supplier_id"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                                <option value="">-- Select Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Order Date *</label>
                            <input type="date" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Expected Delivery Date</label>
                            <input type="date" name="expected_date" value="{{ old('expected_date') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Notes</label>
                            <input type="text" name="notes" value="{{ old('notes') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                    </div>
                </div>
            </div>

            <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;margin-bottom:16px;">
                <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;display:flex;justify-content:space-between;align-items:center;">
                    <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Medicines</h3>
                    <button type="button" onclick="addRow()"
                        style="background:#1a3557;color:#fff;padding:5px 12px;border-radius:6px;border:none;font-size:12px;font-weight:500;cursor:pointer;">+ Add Item</button>
                </div>
                <div style="padding:16px;">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="background:#f8fafc;">
                                <th style="padding:8px 12px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Medicine</th>
                                <th style="padding:8px 12px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Quantity</th>
                                <th style="padding:8px 12px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Unit Price (KES)</th>
                                <th style="padding:8px 12px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Subtotal</th>
                                <th style="padding:8px 12px;"></th>
                            </tr>
                        </thead>
                        <tbody id="medicineRows"></tbody>
                    </table>
                </div>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
                <div style="font-size:16px;font-weight:700;color:#1a2740;">Total: KES <span id="totalDisplay">0.00</span></div>
                <div style="display:flex;gap:10px;">
                    <button type="submit"
                        style="background:#1a3557;color:#fff;padding:8px 20px;border-radius:7px;border:none;font-size:13px;font-weight:500;cursor:pointer;">Create Purchase Order</button>
                    <a href="{{ route('purchases.index') }}"
                        style="background:#f1f5f9;color:#64748b;padding:8px 20px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        const medicines = @json($medicines);
        let rowIndex = 0;
        function addRow() {
            const tbody = document.getElementById('medicineRows');
            const row = document.createElement('tr');
            row.id = `row_${rowIndex}`;
            row.style.borderBottom = '1px solid #f1f5f9';
            row.innerHTML = `
                <td style="padding:8px 12px;">
                    <select name="medicines[${rowIndex}][id]"
                        style="width:100%;padding:6px 10px;border:1px solid #dde3ec;border-radius:6px;font-size:12px;color:#1a2740;outline:none;font-family:inherit;">
                        <option value="">-- Select --</option>
                        ${medicines.map(m => `<option value="${m.id}">${m.name}</option>`).join('')}
                    </select>
                </td>
                <td style="padding:8px 12px;">
                    <input type="number" name="medicines[${rowIndex}][quantity]" min="1" value="1"
                        oninput="updateSubtotal(${rowIndex})"
                        style="width:70px;padding:6px 10px;border:1px solid #dde3ec;border-radius:6px;font-size:12px;outline:none;font-family:inherit;">
                </td>
                <td style="padding:8px 12px;">
                    <input type="number" step="0.01" name="medicines[${rowIndex}][unit_price]" value="0.00"
                        oninput="updateSubtotal(${rowIndex})"
                        style="width:100px;padding:6px 10px;border:1px solid #dde3ec;border-radius:6px;font-size:12px;outline:none;font-family:inherit;">
                </td>
                <td style="padding:8px 12px;">
                    <input type="text" id="subtotal_${rowIndex}" readonly value="0.00"
                        style="width:90px;padding:6px 10px;border:1px solid #dde3ec;border-radius:6px;font-size:12px;background:#f8fafc;">
                </td>
                <td style="padding:8px 12px;">
                    <button type="button" onclick="removeRow(${rowIndex})"
                        style="background:#fee2e2;color:#b91c1c;padding:4px 8px;border-radius:5px;border:none;font-size:11px;cursor:pointer;">✕</button>
                </td>
            `;
            tbody.appendChild(row);
            rowIndex++;
        }
        function updateSubtotal(index) {
            const qty = parseFloat(document.querySelector(`input[name="medicines[${index}][quantity]"]`).value) || 0;
            const price = parseFloat(document.querySelector(`input[name="medicines[${index}][unit_price]"]`).value) || 0;
            document.getElementById(`subtotal_${index}`).value = (qty * price).toFixed(2);
            updateTotal();
        }
        function updateTotal() {
            let sum = 0;
            document.querySelectorAll('[id^="subtotal_"]').forEach(el => sum += parseFloat(el.value) || 0);
            document.getElementById('totalDisplay').textContent = sum.toFixed(2);
        }
        function removeRow(index) {
            document.getElementById(`row_${index}`).remove();
            updateTotal();
        }
        addRow();
    </script>
</x-app-layout>