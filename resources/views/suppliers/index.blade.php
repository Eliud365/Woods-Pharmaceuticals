<x-app-layout>
    <x-slot name="header">Suppliers</x-slot>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <p style="color:#64748b;font-size:13px;margin:0;">Manage all medicine suppliers</p>
        <a href="{{ route('suppliers.create') }}"
           style="background:#1a3557;color:#fff;padding:8px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
            + Add Supplier
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
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">#</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Name</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Contact Person</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Phone</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Email</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">County</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:center;">Status</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $loop->iteration }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#1a2740;font-weight:500;">{{ $supplier->name }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $supplier->contact_person ?? '-' }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $supplier->phone ?? '-' }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $supplier->email ?? '-' }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $supplier->county ?? '-' }}</td>
                        <td style="padding:11px 18px;text-align:center;">
                            @if($supplier->is_active)
                                <span style="background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Active</span>
                            @else
                                <span style="background:#f1f5f9;color:#475569;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:11px 18px;font-size:13px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('suppliers.edit', $supplier) }}"
                                   style="background:#f1f5f9;color:#1a3557;padding:4px 12px;border-radius:6px;text-decoration:none;font-size:12px;font-weight:500;">Edit</a>
                                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                      onsubmit="return confirm('Delete this supplier?')">
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
                        <td colspan="8" style="padding:30px;text-align:center;color:#94a3b8;font-size:13px;">No suppliers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:12px 18px;border-top:1px solid #f1f5f9;">
            {{ $suppliers->links() }}
        </div>
    </div>
</x-app-layout>