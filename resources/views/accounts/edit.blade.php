@extends('layouts.app')

@section('content')
    <h2>Edit Account</h2>
    @include('accounts.form', ['action' => route('accounts.update', $account->id), 'method' => 'PUT', 'account' => $account])
@endsection
