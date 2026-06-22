<x-app-layout>
    <x-slot name="header">Purchase Order: {{ $purchase->reference_number }}</x-slot>

    <div style="max-width:800px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <a href="{{ route('purchases.index') }}"
                style="background:#f1f5f9;color:#64748b;padding:7px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">← Back</a>
            @if($purchase->status === 'pending')
                <form action="{{ route('purchases.receive', $purchase) }}" method="POST"
                      onsubmit="return confirm('Mark as received and update stock?')">
                    @csrf
                    <button type="submit"
                        style="background:#16a34a;color:#fff;padding:8px 16px;border-radius:7px;border:none;font-size:13px;font-weight:500;cursor:pointer;">
                        ✔ Mark as Received
                    </button>
                </form>
            @endif
        </div>

        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
            <div style="padding:16px 24px;border-bottom:1px solid #dde3ec;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <p style="font-size:12px;color:#64748b;margin:0 0 2px;">Reference No</p>
                    <p style="font-size:14px;font-weight:600;color:#1a2740;margin:0 0 12px;">{{ $purchase->reference_number }}</p>
                    <p style="font-size:12px;color:#64748b;margin:0 0 2px;">Supplier</p>
                    <p style="font-size:13px;color:#374151;margin:0 0 12px;">{{ $purchase->supplier->name }}</p>
                    <p style="font-size:12px;color:#64748b;margin:0 0 2px;">Ordered By</p>
                    <p style="font-size:13px;color:#374151;margin:0;">{{ $purchase->user->name }}</p>
                </div>
                <div>
                    <p style="font-size:12px;color:#64748b;margin:0 0 2px;">Order Date</p>
                    <p style="font-size:13px;color:#374151;margin:0 0 12px;">{{ $purchase->order_date->format('d M Y') }}</p>
                    <p style="font-size:12px;color:#64748b;margin:0 0 2px;">Expected Date</p>
                    <p style="font-size:13px;color:#374151;margin:0 0 12px;">{{ $purchase->expected_date ? $purchase->expected_date->format('d M Y') : '-' }}</p>
                    <p style="font-size:12px;color:#64748b;margin:0 0 2px;">Status</p>
                    @if($purchase->status === 'received')
                        <span style="background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Received</span>
                    @elseif($purchase->status === 'pending')
                        <span style="background:#fef3c7;color:#d97706;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Pending</span>
                    @else
                        <span style="background:#fee2e2;color:#b91c1c;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Cancelled</span>
                    @endif
                </div>
            </div>

            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">#</th>
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:left;">Medicine</th>
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:center;">Quantity</th>
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:right;">Unit Price</th>
                        <th style="padding:9px 24px;font-size:10.5px;font-weight:600;text-transform:uppercase;color:#64748b;text-align:right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchase->items as $index => $item)
                        <tr style="border-bottom:1px solid #f1f5f9;">
                            <td style="padding:11px 24px;font-size:13px;color:#374151;">{{ $index + 1 }}</td>
                            <td style="padding:11px 24px;font-size:13px;color:#374151;">{{ $item->medicine->name }}</td>
                            <td style="padding:11px 24px;font-size:13px;color:#374151;text-align:center;">{{ $item->quantity }}</td>
                            <td style="padding:11px 24px;font-size:13px;color:#374151;text-align:right;">KES {{ number_format($item->unit_price, 2) }}</td>
                            <td style="padding:11px 24px;font-size:13px;color:#374151;text-align:right;">KES {{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="border-top:2px solid #dde3ec;">
                        <td colspan="4" style="padding:12px 24px;font-size:14px;font-weight:700;color:#1a2740;text-align:right;">Total</td>
                        <td style="padding:12px 24px;font-size:14px;font-weight:700;color:#1a2740;text-align:right;">KES {{ number_format($purchase->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>

            @if($purchase->notes)
                <div style="padding:14px 24px;border-top:1px solid #dde3ec;">
                    <p style="font-size:12px;color:#64748b;margin:0 0 2px;">Notes</p>
                    <p style="font-size:13px;color:#374151;margin:0;">{{ $purchase->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>