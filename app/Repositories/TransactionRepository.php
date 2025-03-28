<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    // Create a new transaction
    public function create(array $data)
    {
        return Transaction::create($data);
    }

    // Find a transaction by its ID
    public function findById(int $id)
    {
        return Transaction::findOrFail($id);
    }

    // Get all transactions for a specific account
    public function getAllByAccountId(int $accountId)
    {
        return Transaction::where('account_id', $accountId)->get();
    }
}
