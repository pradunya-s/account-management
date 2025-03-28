@extends('layouts.app')

@section('content')
    <h2>Create Account</h2>
    @include('accounts.form', ['action' => route('accounts.store'), 'method' => 'POST', 'account' => new \App\Models\Account()])
@endsection
