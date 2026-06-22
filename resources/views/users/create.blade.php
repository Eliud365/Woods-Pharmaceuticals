<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address *</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role *</label>
                                <select name="role"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                                    <option value="">-- Select Role --</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="pharmacist" {{ old('role') === 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                                    <option value="cashier" {{ old('role') === 'cashier' ? 'selected' : '' }}>Cashier</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password *</label>
                                <input type="password" name="password"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password *</label>
                                <input type="password" name="password_confirmation"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                        </div>

                        <div class="mt-6 flex gap-4">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Create User
                            </button>
                            <a href="{{ route('users.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>