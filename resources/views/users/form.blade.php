<div class="card">
    <div class="card-body">
        <form action="{{ $action }}" method="POST">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email ?? '') }}" required>
            </div>

            @if(!$isEdit)
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>
            @endif

            <button type="submit" class="btn btn-success">{{ $isEdit ? 'Update' : 'Create' }}</button>
        </form>
    </div>
</div>
