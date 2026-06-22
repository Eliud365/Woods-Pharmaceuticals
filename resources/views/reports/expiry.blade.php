<x-app-layout>
    <x-slot name="header">Expiry Report</x-slot>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
        <div style="background:#fefce8;border:1px solid #fde68a;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;color:#b45309;margin:0 0 8px;">Expiring Within 30 Days</p>
            <p style="font-size:28px;font-weight:700;color:#d97706;margin:0;">{{ $expiring_soon->count() }}</p>
        </div>
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:16px;">
            <p style="font-size:11px;font-weight:500;text-transform:uppercase;color:#b91c1c;margin:0 0 8px;">Already Expired</p>
            <p style="font-size:28px;font-weight:700;color:#dc2626;margin:0;">{{ $expired->count() }}</p>
        </div>
    </div>

    @if($expiring_soon->count() > 0)
    <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;margin-bottom:16px;">
        <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;">
            <h3 style="font-size:14px;font-weight:600;margin:0;color:#d97706;">⚠️ Expiring Within 30 Days</h3>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#fefce8;">
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">#</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Medicine</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Category</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:center;">Quantity</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Batch No.</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Expiry Date</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Days Left</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expiring_soon as $index => $medicine)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $index + 1 }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#1a2740;font-weight:500;">{{ $medicine->name }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->category }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:center;">{{ $medicine->quantity }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->batch_number ?? '-' }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->expiry_date->format('d M Y') }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#d97706;font-weight:600;">{{ now()->diffInDays($medicine->expiry_date) }} days</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if($expired->count() > 0)
    <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;margin-bottom:16px;">
        <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;">
            <h3 style="font-size:14px;font-weight:600;margin:0;color:#dc2626;">❌ Expired Medicines</h3>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#fef2f2;">
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">#</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Medicine</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Category</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:center;">Quantity</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Expiry Date</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Expired</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expired as $index => $medicine)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $index + 1 }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#1a2740;font-weight:500;">{{ $medicine->name }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->category }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:center;">{{ $medicine->quantity }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->expiry_date->format('d M Y') }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#dc2626;font-weight:600;">{{ $medicine->expiry_date->diffInDays(now()) }} days ago</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if($expiring_soon->count() === 0 && $expired->count() === 0)
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;padding:30px;text-align:center;color:#64748b;font-size:13px;">
            ✅ No expiry issues found. All medicines are within their expiry dates.
        </div>
    @endif

    <div style="margin-top:16px;">
        <a href="{{ route('reports.index') }}"
            style="background:#f1f5f9;color:#64748b;padding:8px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">← Back to Reports</a>
    </div>
</x-app-layout>