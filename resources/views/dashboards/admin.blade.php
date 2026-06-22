<x-app-layout>
    <x-slot name="header">Admin Dashboard</x-slot>

    <!-- Stats Cards -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:20px;">
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin:0 0 10px;">Total Medicines</p>
            <p style="font-size:28px;font-weight:700;color:#1d4ed8;margin:0;">{{ $total_medicines }}</p>
        </div>
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin:0 0 10px;">Total Suppliers</p>
            <p style="font-size:28px;font-weight:700;color:#1a2740;margin:0;">{{ $total_suppliers }}</p>
        </div>
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin:0 0 10px;">Today's Revenue</p>
            <p style="font-size:24px;font-weight:700;color:#16a34a;margin:0;">KES {{ number_format($today_sales, 2) }}</p>
        </div>
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin:0 0 10px;">Monthly Revenue</p>
            <p style="font-size:24px;font-weight:700;color:#16a34a;margin:0;">KES {{ number_format($monthly_revenue, 2) }}</p>
        </div>
    </div>

    <!-- Alert Cards -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px;">
        <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:600;color:#c2410c;margin:0 0 8px;text-transform:uppercase;">Low Stock Alerts</p>
            <p style="font-size:28px;font-weight:700;color:#c2410c;margin:0 0 8px;">{{ $low_stock }}</p>
            <a href="{{ route('reports.inventory') }}" style="font-size:12px;color:#ea580c;text-decoration:none;">View details →</a>
        </div>
        <div style="background:#fefce8;border:1px solid #fde68a;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:600;color:#b45309;margin:0 0 8px;text-transform:uppercase;">Expiring Soon</p>
            <p style="font-size:28px;font-weight:700;color:#d97706;margin:0 0 8px;">{{ $expiring_soon }}</p>
            <a href="{{ route('reports.expiry') }}" style="font-size:12px;color:#d97706;text-decoration:none;">View details →</a>
        </div>
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:600;color:#b91c1c;margin:0 0 8px;text-transform:uppercase;">Expired Medicines</p>
            <p style="font-size:28px;font-weight:700;color:#dc2626;margin:0 0 8px;">{{ $expired }}</p>
            <a href="{{ route('reports.expiry') }}" style="font-size:12px;color:#dc2626;text-decoration:none;">View details →</a>
        </div>
    </div>

    <!-- Tables -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

        <!-- Recent Sales -->
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
            <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;display:flex;justify-content:space-between;align-items:center;">
                <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Recent Sales</h3>
                <a href="{{ route('sales.index') }}" style="font-size:12px;color:#4a90d9;text-decoration:none;">View all →</a>
            </div>
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Receipt</th>
                        <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Served By</th>
                        <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_sales as $sale)
                        <tr style="border-bottom:1px solid #f1f5f9;">
                            <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $sale->receipt_number }}</td>
                            <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $sale->user->name }}</td>
                            <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:right;">KES {{ number_format($sale->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="padding:20px;text-align:center;color:#94a3b8;font-size:13px;">No sales yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Low Stock Medicines -->
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
            <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;display:flex;justify-content:space-between;align-items:center;">
                <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Low Stock Medicines</h3>
                <a href="{{ route('medicines.index') }}" style="font-size:12px;color:#4a90d9;text-decoration:none;">View all →</a>
            </div>
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Medicine</th>
                        <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:center;">Quantity</th>
                        <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:center;">Reorder Level</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($low_stock_medicines as $medicine)
                        <tr style="border-bottom:1px solid #f1f5f9;">
                            <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->name }}</td>
                            <td style="padding:11px 18px;font-size:13px;color:#dc2626;font-weight:600;text-align:center;">{{ $medicine->quantity }}</td>
                            <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:center;">{{ $medicine->reorder_level }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="padding:20px;text-align:center;color:#94a3b8;font-size:13px;">No low stock medicines.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>