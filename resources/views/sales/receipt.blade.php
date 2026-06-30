<x-app-layout>
    <x-slot name="header">Receipt - {{ $sale->receipt_number }}</x-slot>

    <style>
        @media print {
            .sidebar { display: none !important; }
            .main-area { margin-left: 0 !important; width: 100% !important; }
            .topbar { display: none !important; }
            .body-area { padding: 0 !important; }
            .no-print { display: none !important; }
            #receipt { box-shadow: none !important; border: none !important; }
        }
    </style>

    <div style="max-width:600px;margin:0 auto;">

        <div class="no-print" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <p style="color:#64748b;font-size:13px;margin:0;">Sale completed successfully</p>
            <button onclick="window.print()"
                style="background:#1a3557;color:#fff;padding:8px 16px;border-radius:7px;border:none;font-size:13px;font-weight:500;cursor:pointer;">
                🖨 Print Receipt
            </button>
        </div>

        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;" id="receipt">

            <!-- Header -->
            <div style="padding:24px;text-align:center;border-bottom:1px solid #dde3ec;">
                <div style="width:44px;height:44px;background:#1a3557;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:20px;font-weight:700;margin:0 auto 10px;">W</div>
                <h2 style="font-size:18px;font-weight:700;color:#1a2740;margin:0 0 4px;">Woods Pharmaceuticals</h2>
                <p style="font-size:12px;color:#64748b;margin:0;">Nairobi, Kenya | Tel: +254 700 000 000</p>
                <p style="font-size:13px;font-weight:700;color:#1a2740;margin:12px 0 0;letter-spacing:.12em;">RECEIPT</p>
            </div>

            <!-- Receipt Info -->
            <div style="padding:16px 24px;border-bottom:1px solid #dde3ec;display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;margin:0 0 2px;">Receipt No</p>
                    <p style="font-size:14px;font-weight:700;color:#1a2740;margin:0;">{{ $sale->receipt_number }}</p>
                </div>
                <div style="text-align:right;">
                    <p style="font-size:11px;color:#94a3b8;margin:0 0 2px;">Date</p>
                    <p style="font-size:13px;font-weight:600;color:#1a2740;margin:0;">{{ $sale->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <div>
                    <p style="font-size:11px;color:#94a3b8;margin:0 0 2px;">Customer</p>
                    <p style="font-size:13px;color:#374151;margin:0;">{{ $sale->customer_name ?? 'Walk-in' }}</p>
                </div>
                <div style="text-align:right;">
                    <p style="font-size:11px;color:#94a3b8;margin:0 0 2px;">Served By</p>
                    <p style="font-size:13px;color:#374151;margin:0;">{{ $sale->user->name }}</p>
                </div>
            </div>

            <!-- Items -->
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:1px solid #dde3ec;">
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Item</th>
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:center;">Qty</th>
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:right;">Unit Price</th>
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->items as $item)
                        <tr style="border-bottom:1px solid #f1f5f9;">
                            <td style="padding:10px 24px;font-size:13px;color:#374151;">{{ $item->medicine->name }}</td>
                            <td style="padding:10px 24px;font-size:13px;color:#374151;text-align:center;">{{ $item->quantity }}</td>
                            <td style="padding:10px 24px;font-size:13px;color:#374151;text-align:right;">KES {{ number_format($item->unit_price, 2) }}</td>
                            <td style="padding:10px 24px;font-size:13px;color:#374151;text-align:right;">KES {{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals -->
            <div style="padding:16px 24px;border-top:2px solid #dde3ec;">
                <div style="display:flex;justify-content:space-between;font-size:20px;font-weight:700;color:#1a2740;margin-bottom:12px;">
                    <span>Total</span>
                    <span>KES {{ number_format($sale->total_amount, 2) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;color:#64748b;margin-bottom:4px;">
                    <span>Payment Method</span>
                    <span style="text-transform:capitalize;">{{ $sale->payment_method }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;color:#64748b;margin-bottom:4px;">
                    <span>Amount Paid</span>
                    <span>KES {{ number_format($sale->amount_paid, 2) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;color:#64748b;">
                    <span>Change</span>
                    <span>KES {{ number_format($sale->change_given, 2) }}</span>
                </div>
            </div>

            <!-- Footer -->
            <div style="padding:20px 24px;text-align:center;border-top:1px solid #dde3ec;background:#f8fafc;">
                <p style="font-size:13px;font-weight:600;color:#1a2740;margin:0 0 4px;">
                    You were served by <span style="color:#1a3557;">{{ $sale->user->name }}</span>
                </p>
                <p style="font-size:13px;color:#64748b;margin:0 0 8px;">Thank you for choosing Woods Pharmaceuticals!</p>
                <p style="font-size:14px;font-weight:600;color:#16a34a;margin:0 0 8px;">🌿 Get well soon!</p>
                <p style="font-size:11px;color:#94a3b8;margin:0;">Please keep this receipt for your records.</p>
                <div style="border-top:1px dashed #dde3ec;margin-top:14px;padding-top:12px;">
                    <p style="font-size:11px;color:#94a3b8;margin:0;">Woods Pharmaceuticals · Nairobi, Kenya · +254 700 000 000</p>
                </div>
            </div>

        </div>

        <div class="no-print" style="display:flex;gap:10px;margin-top:16px;">
            <a href="{{ route('sales.create') }}"
                style="background:#1a3557;color:#fff;padding:8px 20px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
                + New Sale
            </a>
            <a href="{{ route('sales.index') }}"
                style="background:#f1f5f9;color:#64748b;padding:8px 20px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
                All Sales
            </a>
        </div>
    </div>
</x-app-layout>