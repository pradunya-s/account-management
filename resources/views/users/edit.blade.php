@extends('layouts.app')

@section('content')
    <h2>Edit User</h2>
    @include('users.form', ['action' => route('users.update', $user->id), 'isEdit' => true])
@endsection
