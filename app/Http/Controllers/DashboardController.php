<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = \App\Models\Item::count();
        $totalStock = \App\Models\Item::sum('stock');
        $lowStockItems = \App\Models\Item::where('stock', '<', 10)->get();
        $recentTransactions = \App\Models\Transaction::with(['item', 'user'])
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('totalItems', 'totalStock', 'lowStockItems', 'recentTransactions'));
    }
}
