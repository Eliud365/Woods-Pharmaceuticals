<x-app-layout>
    <x-slot name="header">Purchase Orders</x-slot>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <p style="color:#64748b;font-size:13px;margin:0;">Manage stock purchase orders</p>
        <a href="{{ route('purchases.create') }}"
           style="background:#1a3557;color:#fff;padding:8px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
            + New Purchase Order
        </a>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fecaca;color:#b91c1c;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">{{ session('error') }}</div>
    @endif

    <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Ref No.</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Supplier</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Order Date</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Expected Date</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:right;">Total (KES)</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:center;">Status</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-size:13px;color:#1a2740;font-weight:500;">{{ $purchase->reference_number }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $purchase->supplier->name }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $purchase->order_date->format('d M Y') }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $purchase->expected_date ? $purchase->expected_date->format('d M Y') : '-' }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:right;">{{ number_format($purchase->total_amount, 2) }}</td>
                        <td style="padding:11px 18px;text-align:center;">
                            @if($purchase->status === 'received')
                                <span style="background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Received</span>
                            @elseif($purchase->status === 'pending')
                                <span style="background:#fef3c7;color:#d97706;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Pending</span>
                            @else
                                <span style="background:#fee2e2;color:#b91c1c;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Cancelled</span>
                            @endif
                        </td>
                        <td style="padding:11px 18px;font-size:13px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('purchases.show', $purchase) }}"
                                   style="background:#dbeafe;color:#1d4ed8;padding:4px 12px;border-radius:6px;text-decoration:none;font-size:12px;font-weight:500;">View</a>
                                @if($purchase->status === 'pending')
                                    <form action="{{ route('purchases.receive', $purchase) }}" method="POST"
                                          onsubmit="return confirm('Mark as received and update stock?')">
                                        @csrf
                                        <button type="submit"
                                            style="background:#dcfce7;color:#15803d;padding:4px 12px;border-radius:6px;border:none;font-size:12px;font-weight:500;cursor:pointer;">Receive</button>
                                    </form>
                                @endif
                                <form action="{{ route('purchases.destroy', $purchase) }}" method="POST"
                                      onsubmit="return confirm('Delete this purchase order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background:#fee2e2;color:#b91c1c;padding:4px 12px;border-radius:6px;border:none;font-size:12px;font-weight:500;cursor:pointer;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:30px;text-align:center;color:#94a3b8;font-size:13px;">No purchase orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:12px 18px;border-top:1px solid #f1f5f9;">
            {{ $purchases->links() }}
        </div>
    </div>
</x-app-layout>