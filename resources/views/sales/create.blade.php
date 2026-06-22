<x-app-layout>
    <x-slot name="header">New Sale</x-slot>

    @if($errors->any())
        <div style="background:#fee2e2;border:1px solid #fecaca;color:#b91c1c;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">
            <ul style="margin:0;padding-left:16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
        @csrf
        <div style="display:grid;grid-template-columns:1.3fr 1fr;gap:20px;">

            <!-- Left: Sale Form -->
            <div>
                <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;margin-bottom:16px;">
                    <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;">
                        <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Customer Info</h3>
                    </div>
                    <div style="padding:16px;">
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            <div>
                                <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Customer Name</label>
                                <input type="text" name="customer_name" placeholder="Walk-in customer"
                                    style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                            </div>
                            <div>
                                <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Payment Method *</label>
                                <select name="payment_method"
                                    style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                                    <option value="cash">Cash</option>
                                    <option value="mpesa">M-Pesa</option>
                                    <option value="insurance">Insurance</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
                    <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;display:flex;justify-content:space-between;align-items:center;">
                        <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Medicines</h3>
                        <button type="button" onclick="addMedicineRow()"
                            style="background:#1a3557;color:#fff;padding:5px 12px;border-radius:6px;border:none;font-size:12px;font-weight:500;cursor:pointer;">+ Add Item</button>
                    </div>
                    <div style="padding:16px;">
                        <table style="width:100%;border-collapse:collapse;">
                            <thead>
                                <tr style="background:#f8fafc;">
                                    <th style="padding:8px 12px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Medicine</th>
                                    <th style="padding:8px 12px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Unit Price</th>
                                    <th style="padding:8px 12px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Qty</th>
                                    <th style="padding:8px 12px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Subtotal</th>
                                    <th style="padding:8px 12px;"></th>
                                </tr>
                            </thead>
                            <tbody id="medicineRows"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right: Summary -->
            <div>
                <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
                    <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;">
                        <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Sale Summary</h3>
                    </div>
                    <div style="padding:16px;">
                        <div style="background:#f8fafc;border:1px solid #dde3ec;border-radius:8px;padding:14px;margin-bottom:16px;">
                            <div style="display:flex;justify-content:space-between;font-size:13px;color:#64748b;padding:4px 0;">
                                <span>Total</span>
                                <span style="font-size:18px;font-weight:700;color:#1a2740;">KES <span id="totalDisplay">0.00</span></span>
                            </div>
                        </div>
                        <div style="margin-bottom:14px;">
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Amount Paid (KES) *</label>
                            <input type="number" step="0.01" name="amount_paid" id="amountPaid" oninput="calculateChange()"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div style="background:#f8fafc;border:1px solid #dde3ec;border-radius:8px;padding:14px;margin-bottom:16px;">
                            <div style="display:flex;justify-content:space-between;font-size:13px;color:#64748b;">
                                <span>Change</span>
                                <span style="font-weight:700;color:#16a34a;">KES <span id="changeDisplay">0.00</span></span>
                            </div>
                        </div>
                        <div style="margin-bottom:14px;">
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Notes</label>
                            <textarea name="notes" rows="2"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;resize:vertical;"></textarea>
                        </div>
                        <div style="display:flex;gap:10px;">
                            <button type="submit"
                                style="flex:1;background:#1a3557;color:#fff;padding:10px;border-radius:7px;border:none;font-size:13px;font-weight:600;cursor:pointer;">
                                ✔ Complete Sale
                            </button>
                            <a href="{{ route('sales.index') }}"
                                style="background:#f1f5f9;color:#64748b;padding:10px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const medicines = @json($medicines);
        let rowIndex = 0;
        let total = 0;

        function addMedicineRow() {
            const tbody = document.getElementById('medicineRows');
            const row = document.createElement('tr');
            row.id = `row_${rowIndex}`;
            row.style.borderBottom = '1px solid #f1f5f9';
            row.innerHTML = `
                <td style="padding:8px 12px;">
                    <select name="medicines[${rowIndex}][id]" onchange="updatePrice(${rowIndex})"
                        style="width:100%;padding:6px 10px;border:1px solid #dde3ec;border-radius:6px;font-size:12px;color:#1a2740;outline:none;font-family:inherit;">
                        <option value="">-- Select --</option>
                        ${medicines.map(m => `<option value="${m.id}" data-price="${m.selling_price}">${m.name} (${m.quantity})</option>`).join('')}
                    </select>
                </td>
                <td style="padding:8px 12px;">
                    <input type="text" id="price_${rowIndex}" readonly value="0.00"
                        style="width:80px;padding:6px 10px;border:1px solid #dde3ec;border-radius:6px;font-size:12px;background:#f8fafc;">
                </td>
                <td style="padding:8px 12px;">
                    <input type="number" name="medicines[${rowIndex}][quantity]" min="1" value="1"
                        oninput="updateSubtotal(${rowIndex})"
                        style="width:60px;padding:6px 10px;border:1px solid #dde3ec;border-radius:6px;font-size:12px;outline:none;font-family:inherit;">
                </td>
                <td style="padding:8px 12px;">
                    <input type="text" id="subtotal_${rowIndex}" readonly value="0.00"
                        style="width:80px;padding:6px 10px;border:1px solid #dde3ec;border-radius:6px;font-size:12px;background:#f8fafc;">
                </td>
                <td style="padding:8px 12px;">
                    <button type="button" onclick="removeRow(${rowIndex})"
                        style="background:#fee2e2;color:#b91c1c;padding:4px 8px;border-radius:5px;border:none;font-size:11px;cursor:pointer;">✕</button>
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
            document.getElementById('changeDisplay').textContent = (paid - total).toFixed(2);
        }

        function removeRow(index) {
            document.getElementById(`row_${index}`).remove();
            updateTotal();
        }

        addMedicineRow();
    </script>
</x-app-layout>