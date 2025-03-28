@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Transaction for {{ $account->account_name }}</h2>

    <!-- Display the account details -->
    <p>Account Name: {{ $account->account_name }}</p>
    <p>Account Type: {{ $account->account_type }}</p>
    <p>Balance: ${{ number_format($account->balance, 2) }}</p>

    <!-- Transaction Form -->
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="account_id" value="{{ $account->id }}">

        <div class="form-group">
            <label for="transaction_type">Transaction Type</label>
            <select name="transaction_type" id="transaction_type" class="form-control">
                <option value="Credit">Credit (Deposit)</option>
                <option value="Debit">Debit (Withdrawal)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required step="0.01" min="0.01" placeholder="Amount" />
        </div>

        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Description" />
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Transaction</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
    </form>

</div>
@endsection
