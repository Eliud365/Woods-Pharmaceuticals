<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Medicine
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

                    <form action="{{ route('medicines.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicine Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Generic Name</label>
                                <input type="text" name="generic_name" value="{{ old('generic_name') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category *</label>
                                <input type="text" name="category" value="{{ old('category') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier</label>
                                <input type="text" name="supplier" value="{{ old('supplier') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity *</label>
                                <input type="number" name="quantity" value="{{ old('quantity') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reorder Level *</label>
                                <input type="number" name="reorder_level" value="{{ old('reorder_level', 10) }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buying Price (KES) *</label>
                                <input type="number" step="0.01" name="buying_price" value="{{ old('buying_price') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selling Price (KES) *</label>
                                <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expiry Date *</label>
                                <input type="date" name="expiry_date" value="{{ old('expiry_date') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Batch Number</label>
                                <input type="text" name="batch_number" value="{{ old('batch_number') }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea name="description" rows="3"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">{{ old('description') }}</textarea>
                            </div>

                        </div>

                        <div class="mt-6 flex gap-4">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Save Medicine
                            </button>
                            <a href="{{ route('medicines.index') }}"
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