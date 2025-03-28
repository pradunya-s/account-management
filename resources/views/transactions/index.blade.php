@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transactions for {{ $account->account_name }}</h2>

    <!-- Display the account details -->
    <p>Account Name: {{ $account->account_name }}</p>
    <p>Account Type: {{ $account->account_type }}</p>
    <p>Balance: {{ number_format($account->balance, 2) }}</p>

    <!-- Link to create a new transaction for this account -->
    <a href="{{ route('transactions.create', $account) }}" class="btn btn-primary">Add Transaction</a>

    <!-- Back Button -->
    <a href="{{ route('accounts.index') }}" class="btn btn-secondary my-3">Back</a>

    <h3 class="my-3">Transaction History</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No transactions found for this account.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
