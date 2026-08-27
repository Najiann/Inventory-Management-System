<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Product Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col gap-6 sm:flex-row">
                    <div class="shrink-0">
                        @if ($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="h-48 w-48 rounded-lg object-cover"
                            >
                        @else
                            <div class="flex h-48 w-48 items-center justify-center rounded-lg bg-gray-200 text-sm text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                No image
                            </div>
                        @endif
                    </div>

                    <dl class="grid flex-1 grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Product Name</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">SKU</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">{{ $product->sku }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Category</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">{{ $product->category?->name ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Price</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Stock</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">{{ $product->stock }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Condition</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">{{ ucfirst($product->condition) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Location</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">{{ $product->location }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Description</dt>
                            <dd class="whitespace-pre-line font-medium text-gray-900 dark:text-white">{{ $product->description ?: '—' }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <a href="{{ route('products.edit', $product) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        Edit Product
                    </a>
                    <a href="{{ route('products.index') }}" class="rounded-lg bg-gray-500 px-4 py-2 text-sm font-medium text-white hover:bg-gray-600">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
