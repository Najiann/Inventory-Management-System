<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Admin Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Ringkasan performa dan metrik inventaris sistem secara real-time.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('products.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    + Tambah Produk
                </a>
                <a href="{{ route('transactions.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    Riwayat Transaksi
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stat Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Produk -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Barang</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($totalProducts) }}</h3>
                        <a href="{{ route('products.index') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline mt-2 inline-block">Lihat semua produk &rarr;</a>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Kategori</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($totalCategories) }}</h3>
                        <a href="{{ route('categories.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline mt-2 inline-block">Kelola kategori &rarr;</a>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>

                <!-- Total Unit Stok -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Unit Stok</p>
                        <h3 class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ number_format($totalStock) }}</h3>
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-2 block">Unit aktif di gudang</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Transaksi</p>
                        <h3 class="text-2xl font-bold text-purple-600 dark:text-purple-400 mt-1">{{ number_format($totalTransactions) }}</h3>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            <span class="text-emerald-600 font-semibold">+{{ $totalInQty }} In</span> / 
                            <span class="text-rose-600 font-semibold">-{{ $totalOutQty }} Out</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/40 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two Columns: Recent Transactions & Low Stock Alert -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Transaksi Terbaru (2 Cols) -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100 dark:border-gray-700">
                        <div>
                            <h4 class="text-base font-bold text-gray-900 dark:text-white">Aktivitas Transaksi Terbaru</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Catatan mutasi barang terakhir di gudang</p>
                        </div>
                        <a href="{{ route('transactions.index') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                            <thead>
                                <tr class="text-left text-xs font-semibold text-gray-400 uppercase">
                                    <th class="py-2">Waktu</th>
                                    <th class="py-2">Tipe</th>
                                    <th class="py-2">Barang</th>
                                    <th class="py-2 text-center">Qty</th>
                                    <th class="py-2">Staf</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-750">
                                @forelse ($recentTransactions as $tx)
                                    <tr>
                                        <td class="py-3 text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                            {{ $tx->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="py-3">
                                            @if ($tx->type === 'in')
                                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                                    IN
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold bg-rose-100 text-rose-800 dark:bg-rose-900/50 dark:text-rose-300">
                                                    OUT
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $tx->product ? $tx->product->name : '-' }}
                                        </td>
                                        <td class="py-3 text-center font-bold {{ $tx->type === 'in' ? 'text-emerald-600' : 'text-rose-600' }}">
                                            {{ $tx->type === 'in' ? '+' : '-' }}{{ $tx->quantity }}
                                        </td>
                                        <td class="py-3 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $tx->user ? $tx->user->name : 'Sistem' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-xs text-gray-400">
                                            Belum ada transaksi inventaris tercatat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Alert Stok Rendah (1 Col) -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                            <h4 class="text-base font-bold text-gray-900 dark:text-white">Peringatan Stok Rendah</h4>
                        </div>
                        <span class="text-xs bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300 px-2 py-0.5 rounded-full font-medium">
                            &le; 5 Unit
                        </span>
                    </div>

                    <div class="space-y-3">
                        @forelse ($lowStockProducts as $low)
                            <div class="p-3 rounded-lg border {{ $low->stock == 0 ? 'border-red-200 bg-red-50/50 dark:bg-red-950/20 dark:border-red-900' : 'border-amber-200 bg-amber-50/50 dark:bg-amber-950/20 dark:border-amber-900' }} flex items-center justify-between">
                                <div>
                                    <h5 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $low->name }}</h5>
                                    <p class="text-xs text-gray-500 font-mono">SKU: {{ $low->sku }}</p>
                                    <span class="text-xs text-gray-400">{{ $low->category ? $low->category->name : '-' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-bold {{ $low->stock == 0 ? 'text-red-600' : 'text-amber-600' }}">
                                        {{ $low->stock }}
                                    </span>
                                    <span class="text-xs text-gray-400 block">Sisa Unit</span>
                                    <a href="{{ route('transactions.stock-in') }}" class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold hover:underline mt-1 inline-block">
                                        + Restock
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="py-8 text-center text-gray-400 text-xs">
                                <svg class="w-8 h-8 mx-auto text-emerald-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Seluruh stok barang dalam kondisi aman (&gt; 5 unit).
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
