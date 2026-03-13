@extends('layouts.inventory')

@section('title', 'Dashboard')
@section('header', 'System Overview')

@section('content')
<div class="stats-grid">
    <div class="glass-card stat-card">
        <div class="stat-label">Total Items</div>
        <div class="stat-value">{{ $totalItems }}</div>
        <div style="font-size: 0.75rem; color: var(--success);"><i class="fas fa-boxes"></i> Master Data</div>
    </div>
    
    <div class="glass-card stat-card">
        <div class="stat-label">Total Stock</div>
        <div class="stat-value">{{ number_format($totalStock) }}</div>
        <div style="font-size: 0.75rem; color: var(--primary);"><i class="fas fa-warehouse"></i> Units in Warehouse</div>
    </div>
    
    <div class="glass-card stat-card">
        <div class="stat-label">Low Stock Alerts</div>
        <div class="stat-value" style="color: var(--danger);">{{ $lowStockItems->count() }}</div>
        <div style="font-size: 0.75rem; color: var(--danger);"><i class="fas fa-exclamation-triangle"></i> Needs reorder</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Recent Activity -->
    <div class="glass-card">
        <h3 style="margin-bottom: 1.5rem;">Recent Activity</h3>
        <div class="table-container" style="margin-top: 0;">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransactions as $transaction)
                    <tr>
                        <td>{{ $transaction->item->name }}</td>
                        <td>
                            <span class="badge {{ $transaction->type === 'in' ? 'badge-success' : 'badge-danger' }}">
                                {{ strtoupper($transaction->type) }}
                            </span>
                        </td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ $transaction->date->format('d M H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Low Stock Details -->
    <div class="glass-card">
        <h3 style="margin-bottom: 1.5rem;">Low Stock Alerts</h3>
        <div class="table-container" style="margin-top: 0;">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>SKU</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowStockItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td><code>{{ $item->sku }}</code></td>
                        <td style="color: var(--danger); font-weight: 600;">{{ $item->stock }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
