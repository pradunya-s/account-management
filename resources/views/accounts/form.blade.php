<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Account Number</label>
        <input type="text" name="account_number" class="form-control" value="{{ $account->account_number }}" disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">Account Name</label>
        <input type="text" name="account_name" class="form-control" value="{{ old('account_name', $account->account_name) }}" required>
        @error('account_name') 
            <div class="text-danger">{{ $message }}</div> 
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Account Type</label>
        <select name="account_type" class="form-control" required>
            <option value="Personal" {{ old('account_type', $account->account_type) == 'Personal' ? 'selected' : '' }}>Personal</option>
            <option value="Business" {{ old('account_type', $account->account_type) == 'Business' ? 'selected' : '' }}>Business</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Currency</label>
        <select name="currency" class="form-control" required>
            <option value="USD" {{ old('currency', $account->currency) == 'USD' ? 'selected' : '' }}>USD</option>
            <option value="EUR" {{ old('currency', $account->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
            <option value="GBP" {{ old('currency', $account->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Initial Balance (Optional)</label>
        <input type="number" name="balance" class="form-control" value="{{ old('balance', $account->balance) }}" step="0.01">
    </div>

    <button type="submit" class="btn btn-success">{{ $method === 'PUT' ? 'Update' : 'Create' }} Account</button>
    <a href="{{ route('accounts.index') }}" class="btn btn-secondary my-3">Back</a>
    
</form>
