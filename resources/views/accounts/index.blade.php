@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <h2>Accounts</h2>
        <a href="{{ route('accounts.create') }}" class="btn btn-primary">Create Account</a>
    </div>

    

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Account Name</th>
                <th>Type</th>
                <th>Currency</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
                <tr>
                    <td>{{ $account->account_name }}</td>
                    <td>{{ $account->account_type }}</td>
                    <td>{{ $account->currency }}</td>
                    <td>{{ number_format($account->balance, 2) }}</td>
                    <td>
                        <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('transactions.index', $account->id) }}" class="btn btn-primary">Transactions</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
