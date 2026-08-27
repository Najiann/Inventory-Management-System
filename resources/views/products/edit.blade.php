<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-700" role="alert">
                        <p class="font-medium">Please fix the following errors:</p>
                        <ul class="mt-1 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('products.update', $product->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4"
                >

                    @csrf
                    @method('PUT')

                    {{-- Category --}}
                    <div>
                        <label
                            for="category_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Category
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            required
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"
                        >

                            <option value="">Select Category</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Product Name --}}
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Product Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $product->name) }}"
                            required
                            placeholder="Masukkan nama produk..."
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>

                    {{-- SKU --}}
                    <div>
                        <label
                            for="sku"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            SKU
                        </label>

                        <input
                            type="text"
                            name="sku"
                            id="sku"
                            value="{{ old('sku', $product->sku) }}"
                            required
                            readonly
                            placeholder="Contoh: KB-001"
                            class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-gray-300 border-gray-300 dark:border-gray-600"
                        >
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">SKU tidak dapat diubah setelah produk dibuat.</p>
                    </div>

                    {{-- Price --}}
                    <div>
                        <label
                            for="price"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Price
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            value="{{ old('price', $product->price) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>

                    {{-- Stock --}}
                    <div>
                        <label
                            for="stock"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Stock
                        </label>

                        <input
                            type="number"
                            name="stock"
                            id="stock"
                            value="{{ old('stock', $product->stock) }}"
                            min="0"
                            required
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>

                    {{-- Condition --}}
                    <div>
                        <label
                            for="condition"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Condition
                        </label>

                        <select
                            name="condition"
                            id="condition"
                            required
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"
                        >

                            <option value="">Select Condition</option>

                            <option
                                value="good"
                                {{ old('condition', $product->condition) == 'good' ? 'selected' : '' }}
                            >
                                Good
                            </option>

                            <option
                                value="damaged"
                                {{ old('condition', $product->condition) == 'damaged' ? 'selected' : '' }}
                            >
                                Damaged
                            </option>

                        </select>
                    </div>

                    {{-- Location --}}
                    <div>
                        <label
                            for="location"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Location
                        </label>

                        <input
                            type="text"
                            name="location"
                            id="location"
                            value="{{ old('location', $product->location) }}"
                            required
                            placeholder="Contoh: Warehouse A"
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>

                    {{-- Description --}}
                    <div>
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            placeholder="Deskripsi produk..."
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"
                        >{{ old('description', $product->description) }}</textarea>
                    </div>

                    {{-- Image --}}
                    <div>
                        <label
                            for="image"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Product Image
                        </label>

                        @if ($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="mb-2 h-24 w-24 rounded-lg object-cover"
                            >
                        @endif

                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept="image/jpeg,image/png,image/jpg"
                            class="w-full text-sm text-gray-700 dark:text-gray-300"
                        >
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kosongkan jika tidak ingin mengganti gambar.</p>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3 pt-2">

                        <button
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg transition duration-150"
                        >
                            Update Product
                        </button>

                        <a
                            href="{{ route('products.index') }}"
                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium text-sm rounded-lg transition duration-150"
                        >
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>