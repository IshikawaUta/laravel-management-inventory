@extends('layouts.inventory')

@section('title', 'Transactions History')
@section('header', 'Inventory Movements')

@section('actions')
<a href="{{ route('transactions.create') }}" class="btn btn-primary">
    <i class="fas fa-plus" style="margin-right: 8px;"></i> Record Movement
</a>
@endsection

@section('content')
<div class="glass-card">
    <div class="table-container" style="margin-top: 0;">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Reference</th>
                    <th>Staff</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->date->format('d M Y, H:i') }}</td>
                    <td style="font-weight: 500;">{{ $transaction->item->name }}</td>
                    <td>
                        <span class="badge {{ $transaction->type === 'in' ? 'badge-success' : 'badge-danger' }}">
                            {{ strtoupper($transaction->type) }}
                        </span>
                    </td>
                    <td style="font-weight: 600;">{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->reference_name ?? '-' }}</td>
                    <td>{{ $transaction->user->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                        No transactions recorded yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
