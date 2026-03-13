@extends('layouts.inventory')

@section('title', 'Reports')
@section('header', 'Transaction Reports')

@section('content')
<div class="glass-card" style="margin-bottom: 2rem;">
    <form action="{{ route('reports.index') }}" method="GET" style="display: flex; gap: 1.5rem; align-items: flex-end; flex-wrap: wrap;">
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Start Date</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" 
                style="padding: 0.6rem; border-radius: 0.5rem; border: 1px solid var(--border);">
        </div>
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">End Date</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" 
                style="padding: 0.6rem; border-radius: 0.5rem; border: 1px solid var(--border);">
        </div>
        <div style="display: flex; gap: 0.75rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter" style="margin-right: 8px;"></i> Filter
            </button>
            <a href="{{ route('reports.export', request()->all()) }}" class="btn" style="background: var(--success); color: white;">
                <i class="fas fa-file-csv" style="margin-right: 8px;"></i> Export CSV
            </a>
            <a href="{{ route('reports.index') }}" class="btn" style="background: var(--border); color: var(--text-main);">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="glass-card">
    <div class="table-container" style="margin-top: 0;">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Item</th>
                    <th>SKU</th>
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Staff</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->date->format('d M Y, H:i') }}</td>
                    <td style="font-weight: 500;">{{ $transaction->item->name }}</td>
                    <td><code>{{ $transaction->item->sku }}</code></td>
                    <td>
                        <span class="badge {{ $transaction->type === 'in' ? 'badge-success' : 'badge-danger' }}">
                            {{ strtoupper($transaction->type) }}
                        </span>
                    </td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->user->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                        No data found for the selected range.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
