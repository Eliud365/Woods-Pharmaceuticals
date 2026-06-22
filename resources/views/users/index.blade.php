<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                System Users
            </h2>
            <a href="{{ route('users.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Add User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Created</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-medium">
                                        {{ $user->name }}
                                        @if($user->id === auth()->id())
                                            <span class="ml-1 px-2 py-0.5 bg-blue-100 text-blue-700 rounded text-xs">You</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-3">
                                        @if($user->role === 'admin')
                                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs capitalize">Admin</span>
                                        @elseif($user->role === 'pharmacist')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs capitalize">Pharmacist</span>
                                        @else
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs capitalize">Cashier</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <a href="{{ route('users.edit', $user) }}"
                                           class="text-blue-600 hover:underline">Edit</a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                  onsubmit="return confirm('Delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>