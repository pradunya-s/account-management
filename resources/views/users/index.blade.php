@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Users</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
    </div>

    @if($users->isEmpty())
        <div class="alert alert-warning mt-3">No users found.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
