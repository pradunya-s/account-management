<?php
namespace App\Repositories;

use App\Models\Account;
use App\Helpers\LuhnHelper;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function all()
    {
        return Account::where('user_id', Auth::id())->get();
    }

    public function findById($id)
    {
        return Account::where('user_id', Auth::id())->findOrFail($id);
    }

    public function create(array $data)
    {
        return Account::create([
            'user_id' => auth()->id(),
            'account_name' => $data['account_name'],
            'account_number' => LuhnHelper::generateAccountNumber(), // Generate Luhn number
            'account_type' => $data['account_type'],
            'currency' => $data['currency'],
            'balance' => $data['balance'] ?? 0,
        ]);
    }

    public function update(Account $account, array $data)
    {
        return $account->update($data);
    }

    public function delete(Account $account)
    {
        return $account->delete();
    }
}
