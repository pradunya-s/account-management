<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Create Transaction
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_id' => 'required|exists:accounts,id',
            'transaction_type' => 'required|in:Credit,Debit',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $account = Account::find($request->account_id);

        // Ensure there is enough balance for debit transactions
        if ($request->transaction_type === 'Debit' && $account->balance < $request->amount) {
            return response()->json(['error' => 'Insufficient balance for this transaction'], 400);
        }

        // Create the transaction
        $transaction = Transaction::create([
            'account_id' => $request->account_id,
            'transaction_type' => $request->transaction_type,
            'amount' => $request->amount,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        // Update account balance
        if ($request->transaction_type === 'Credit') {
            $account->balance += $request->amount;
        } else {
            $account->balance -= $request->amount;
        }
        $account->save();

        return response()->json($transaction, 201);
    }

    // Fetch Transactions
    public function index(Request $request)
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->where('account_id', $request->account_id)
            ->whereBetween('created_at', [$request->from, $request->to])
            ->get();

        return response()->json($transactions);
    }
}
