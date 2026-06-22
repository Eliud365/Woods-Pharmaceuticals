<x-app-layout>
    <x-slot name="header">System Users</x-slot>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <p style="color:#64748b;font-size:13px;margin:0;">Manage system users and their roles</p>
        <a href="{{ route('users.create') }}"
           style="background:#1a3557;color:#fff;padding:8px 16px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
            + Add User
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
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">#</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Name</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Email</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:center;">Role</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Created</th>
                    <th style="padding:9px 18px;font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#64748b;text-align:left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $loop->iteration }}</td>
                        <td style="padding:11px 18px;font-size:13px;color:#1a2740;font-weight:500;">
                            {{ $user->name }}
                            @if($user->id === auth()->id())
                                <span style="background:#dbeafe;color:#1d4ed8;padding:1px 6px;border-radius:10px;font-size:10px;font-weight:500;margin-left:4px;">You</span>
                            @endif
                        </td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $user->email }}</td>
                        <td style="padding:11px 18px;text-align:center;">
                            @if($user->role === 'admin')
                                <span style="background:#ede9fe;color:#6d28d9;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Admin</span>
                            @elseif($user->role === 'pharmacist')
                                <span style="background:#dbeafe;color:#1d4ed8;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Pharmacist</span>
                            @else
                                <span style="background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;">Cashier</span>
                            @endif
                        </td>
                        <td style="padding:11px 18px;font-size:13px;color:#374151;">{{ $user->created_at->format('d M Y') }}</td>
                        <td style="padding:11px 18px;font-size:13px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('users.edit', $user) }}"
                                   style="background:#f1f5f9;color:#1a3557;padding:4px 12px;border-radius:6px;text-decoration:none;font-size:12px;font-weight:500;">Edit</a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Delete this user?')">
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
                    <tr><td colspan="6" style="padding:30px;text-align:center;color:#94a3b8;font-size:13px;">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:12px 18px;border-top:1px solid #f1f5f9;">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>