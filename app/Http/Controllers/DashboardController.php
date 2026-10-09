<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard with overview statistics, low stock alerts, and recent activity.
     */
    public function admin()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalTransactions = StockTransaction::count();
        $totalStock = Product::sum('stock');

        // Low stock products (stock <= 5)
        $lowStockProducts = Product::with('category')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Recent 5 transactions
        $recentTransactions = StockTransaction::with(['product', 'user'])
            ->latest()
            ->take(6)
            ->get();

        // Total IN vs OUT quantity
        $totalInQty = StockTransaction::where('type', 'in')->sum('quantity');
        $totalOutQty = StockTransaction::where('type', 'out')->sum('quantity');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalTransactions',
            'totalStock',
            'lowStockProducts',
            'recentTransactions',
            'totalInQty',
            'totalOutQty'
        ));
    }

    /**
     * Staff Dashboard with operational shortcuts and recent transactions.
     */
    public function staff()
    {
        $totalProducts = Product::count();
        $myTransactionsCount = StockTransaction::where('user_id', auth()->id())->count();

        // Recent Stock In
        $recentStockIns = StockTransaction::with('product')
            ->where('type', 'in')
            ->latest()
            ->take(5)
            ->get();

        // Recent Stock Out
        $recentStockOuts = StockTransaction::with('product')
            ->where('type', 'out')
            ->latest()
            ->take(5)
            ->get();

        // Products with low stock alert
        $lowStockProducts = Product::with('category')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('staff.dashboard', compact(
            'totalProducts',
            'myTransactionsCount',
            'recentStockIns',
            'recentStockOuts',
            'lowStockProducts'
        ));
    }
}

