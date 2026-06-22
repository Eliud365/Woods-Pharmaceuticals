<x-app-layout>
    <x-slot name="header">Inventory Report</x-slot>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:20px;">
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;color:#64748b;margin:0 0 8px;">Total Medicines</p>
            <p style="font-size:28px;font-weight:700;color:#1a2740;margin:0;">{{ $medicines->count() }}</p>
        </div>
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;color:#64748b;margin:0 0 8px;">Low Stock</p>
            <p style="font-size:28px;font-weight:700;color:#c2410c;margin:0;">{{ $low_stock->count() }}</p>
        </div>
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;color:#64748b;margin:0 0 8px;">Expiring Soon</p>
            <p style="font-size:28px;font-weight:700;color:#d97706;margin:0;">{{ $expiring_soon->count() }}</p>
        </div>
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;color:#64748b;margin:0 0 8px;">Expired</p>
            <p style="font-size:28px;font-weight:700;color:#dc2626;margin:0;">{{ $expired->count() }}</p>
        </div>
    </div>

    <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
        <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;">
            <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Full Inventory</h3>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">#</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Name</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Category</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:center;">Qty</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:center;">Reorder</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:right;">Buy Price</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:right;">Sell Price</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Expiry</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicines as $medicine)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $loop->iteration }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#1a2740;font-weight:500;">{{ $medicine->name }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->category }}</td>
                        <td style="padding:11px 18px;font-size:13px;text-align:center;{{ $medicine->isLowStock() ? 'color:#dc2626;font-weight:700;' : 'color:#374151;' }}">{{ $medicine->quantity }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:center;">{{ $medicine->reorder_level }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:right;">KES {{ number_format($medicine->buying_price, 2) }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:right;">KES {{ number_format($medicine->selling_price, 2) }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->expiry_date->format('d M Y') }}</td>
                        <td style="padding:11px 18px;text-align:center;">
                            @if($medicine->isExpired())
                                <span style="background:#fee2e2;color:#b91c1c;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Expired</span>
                            @elseif($medicine->isExpiringSoon())
                                <span style="background:#fef3c7;color:#d97706;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Expiring Soon</span>
                            @elseif($medicine->isLowStock())
                                <span style="background:#ffedd5;color:#c2410c;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Low Stock</span>
                            @else
                                <span style="background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">OK</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" style="padding:30px;text-align:center;color:#94a3b8;font-size:13px;">No medicines found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">
        <a href="{{ route('reports.index') }}"
            style="background:#f1f5f9;color:#64748b;padding:8px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">← Back to Reports</a>
    </div>
</x-app-layout>