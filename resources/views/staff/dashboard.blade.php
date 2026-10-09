<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Staff Dashboard (Gudang)') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Panel operasional staf gudang untuk transaksi barang masuk, keluar, dan pemantauan stok.
                </p>
            </div>
            <div class="text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 px-4 py-2 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm">
                Petugas Aktif: <span class="font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Success Message -->
            @if (session('success'))
                <div class="p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Quick Action Cards (Staff Primary Actions) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Action: Catat Stock In -->
                <a href="{{ route('transactions.stock-in') }}" 
                   class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 p-6 rounded-2xl shadow-md transition-all duration-200 hover:shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm mb-2">
                                Operasional Masuk
                            </span>
                            <h3 class="text-2xl font-bold">Catat Barang Masuk (Stock In)</h3>
                            <p class="text-sm text-emerald-100 mt-1 max-w-sm">
                                Input penerimaan barang baru, pengadaan vendor, atau pengembalian unit ke stok gudang.
                            </p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/20 flex items-center text-xs font-semibold text-white group-hover:translate-x-1 transition-transform">
                        Buka Form Input Barang Masuk &rarr;
                    </div>
                </a>

                <!-- Action: Catat Stock Out -->
                <a href="{{ route('transactions.stock-out') }}" 
                   class="group relative overflow-hidden bg-gradient-to-br from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 p-6 rounded-2xl shadow-md transition-all duration-200 hover:shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm mb-2">
                                Operasional Keluar
                            </span>
                            <h3 class="text-2xl font-bold">Catat Barang Keluar (Stock Out)</h3>
                            <p class="text-sm text-rose-100 mt-1 max-w-sm">
                                Catat pengeluaran barang untuk divisi, karyawan, atau pemindahan keluar dengan validasi stok otomatis.
                            </p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/20 flex items-center text-xs font-semibold text-white group-hover:translate-x-1 transition-transform">
                        Buka Form Input Barang Keluar &rarr;
                    </div>
                </a>
            </div>

            <!-- Operational Stat Summary -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Katalog Barang</p>
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalProducts }} Item</h4>
                        <a href="{{ route('products.index') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline mt-1 inline-block">Lihat daftar barang &rarr;</a>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Diproses Oleh Saya</p>
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $myTransactionsCount }} Transaksi</h4>
                        <a href="{{ route('transactions.index') }}" class="text-xs text-gray-500 hover:underline mt-1 inline-block">Semua riwayat transaksi &rarr;</a>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Stok Menipis (&le; 5)</p>
                        <h4 class="text-xl font-bold text-amber-600 mt-1">{{ $lowStockProducts->count() }} Item</h4>
                        <span class="text-xs text-gray-400 mt-1 block">Perlu restock</span>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-amber-50 dark:bg-amber-900/30 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two-Column Feed: Recent Stock In & Recent Stock Out -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Barang Masuk Terbaru -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="p-1 rounded bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                </svg>
                            </span>
                            <h4 class="text-base font-bold text-gray-900 dark:text-white">Barang Masuk Terbaru</h4>
                        </div>
                        <a href="{{ route('transactions.index', ['type' => 'in']) }}" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline font-semibold">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse ($recentStockIns as $in)
                            <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-750 flex items-center justify-between">
                                <div>
                                    <h5 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $in->product ? $in->product->name : '-' }}</h5>
                                    <p class="text-xs text-gray-500 font-mono">SKU: {{ $in->product ? $in->product->sku : '-' }}</p>
                                    <span class="text-xs text-gray-400">{{ $in->created_at->format('d M, H:i') }} &bull; {{ $in->description ?: 'Tanpa keterangan' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-base font-bold text-emerald-600 dark:text-emerald-400">+{{ $in->quantity }} Unit</span>
                                </div>
                            </div>
                        @empty
                            <div class="py-6 text-center text-xs text-gray-400">
                                Belum ada barang masuk yang tercatat.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Barang Keluar Terbaru -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="p-1 rounded bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                </svg>
                            </span>
                            <h4 class="text-base font-bold text-gray-900 dark:text-white">Barang Keluar Terbaru</h4>
                        </div>
                        <a href="{{ route('transactions.index', ['type' => 'out']) }}" class="text-xs text-rose-600 dark:text-rose-400 hover:underline font-semibold">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse ($recentStockOuts as $out)
                            <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-750 flex items-center justify-between">
                                <div>
                                    <h5 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $out->product ? $out->product->name : '-' }}</h5>
                                    <p class="text-xs text-gray-500 font-mono">SKU: {{ $out->product ? $out->product->sku : '-' }}</p>
                                    <span class="text-xs text-gray-400">{{ $out->created_at->format('d M, H:i') }} &bull; {{ $out->description ?: 'Tanpa keterangan' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-base font-bold text-rose-600 dark:text-rose-400">-{{ $out->quantity }} Unit</span>
                                </div>
                            </div>
                        @empty
                            <div class="py-6 text-center text-xs text-gray-400">
                                Belum ada barang keluar yang tercatat.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
