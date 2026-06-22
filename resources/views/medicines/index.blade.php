<x-app-layout>
    <x-slot name="header">Medicines Inventory</x-slot>

    <!-- Top Bar -->
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <p style="color:#64748b;font-size:13px;margin:0;">Manage all medicines in stock</p>
        <a href="{{ route('medicines.create') }}"
           style="background:#1a3557;color:#fff;padding:8px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
            + Add Medicine
        </a>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">#</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Name</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Category</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:center;">Quantity</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Selling Price</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Expiry Date</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:center;">Status</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicines as $medicine)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $loop->iteration }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#1a2740;font-weight:500;">{{ $medicine->name }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->category }}</td>
                        <td style="padding:11px 18px;font-size:13px;text-align:center;{{ $medicine->isLowStock() ? 'color:#dc2626;font-weight:700;' : 'color:#374151;' }}">{{ $medicine->quantity }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">KES {{ number_format($medicine->selling_price, 2) }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $medicine->expiry_date->format('d M Y') }}</td>
                        <td style="padding:11px 18px;text-align:center;">
                            @if($medicine->isExpired())
                                <span style="background:#fee2e2;color:#b91c1c;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Expired</span>
                            @elseif($medicine->isExpiringSoon())
                                <span style="background:#fef3c7;color:#d97706;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Expiring Soon</span>
                            @elseif($medicine->isLowStock())
                                <span style="background:#ffedd5;color:#c2410c;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Low Stock</span>
                            @else
                                <span style="background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">In Stock</span>
                            @endif
                        </td>
                        <td style="padding:11px 18px;font-size:13px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('medicines.edit', $medicine) }}"
                                   style="background:#f1f5f9;color:#1a3557;padding:4px 12px;border-radius:6px;text-decoration:none;font-size:12px;font-weight:500;">Edit</a>
                                <form action="{{ route('medicines.destroy', $medicine) }}" method="POST"
                                      onsubmit="return confirm('Delete this medicine?')">
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
                        <td colspan="8" style="padding:30px;text-align:center;color:#94a3b8;font-size:13px;">
                            No medicines found. Add your first medicine.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:12px 18px;border-top:1px solid #f1f5f9;">
            {{ $medicines->links() }}
        </div>
    </div>
</x-app-layout>