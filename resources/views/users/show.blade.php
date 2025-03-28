@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Details</h2>

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $user->created_at->format('d M Y H:i') }}</td>
        </tr>
    </table>

    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
