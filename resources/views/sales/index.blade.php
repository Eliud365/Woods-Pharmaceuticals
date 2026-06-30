<x-app-layout>
    <x-slot name="header">Sales Transactions</x-slot>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <p style="color:#64748b;font-size:13px;margin:0;">All recorded sales transactions</p>
        <a href="{{ route('sales.create') }}"
           style="background:#1a3557;color:#fff;padding:8px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
            + New Sale
        </a>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Receipt No.</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Customer</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Served By</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Payment</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:right;">Total (KES)</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Date</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-size:13px;color:#1a2740;font-weight:500;">{{ $sale->receipt_number }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $sale->customer_name ?? 'Walk-in' }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $sale->user->name }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;text-transform:capitalize;">{{ $sale->payment_method }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;text-align:right;">{{ number_format($sale->total_amount, 2) }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $sale->created_at->format('d M Y, h:i A') }}</td>
                        <td style="padding:11px 18px;font-size:13px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('sales.receipt', $sale->id) }}"
                                   style="background:#dbeafe;color:#1d4ed8;padding:4px 12px;border-radius:6px;text-decoration:none;font-size:12px;font-weight:500;">Receipt</a>
                                @if(auth()->user()->isAdmin())
                                    <form action="{{ route('sales.destroy', $sale) }}" method="POST"
                                          onsubmit="return confirm('Delete this sale?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background:#fee2e2;color:#b91c1c;padding:4px 12px;border-radius:6px;border:none;font-size:12px;font-weight:500;cursor:pointer;">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:30px;text-align:center;color:#94a3b8;font-size:13px;">No sales recorded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:12px 18px;border-top:1px solid #f1f5f9;">
            {{ $sales->links() }}
        </div>
    </div>
</x-app-layout>