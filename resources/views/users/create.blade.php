@extends('layouts.app')

@section('content')
    <h2>Create User</h2>
    @include('users.form', ['action' => route('users.store'), 'isEdit' => false])
@endsection
