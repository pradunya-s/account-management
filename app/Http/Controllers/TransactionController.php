<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Account $account)
    {
        $transactions = $account->transactions;
        return view('transactions.index', compact('account', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Account $account)
    {
        return view('transactions.create', compact('account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
    $request->validate([
        'account_id' => 'required|exists:accounts,id',
        'transaction_type' => 'required|in:Credit,Debit',
        'amount' => 'required|numeric|min:0.01',
        'description' => 'nullable|string|max:255',
    ]);

    $account = Account::findOrFail($request->account_id);

    // Prevent overdrafts for debit transactions
    if ($request->transaction_type === 'Debit' && $account->balance < $request->amount) {
        return redirect()->back()->withErrors(['amount' => 'Insufficient balance for this transaction']);
    }

    // Create the transaction using the repository pattern
    $transaction = $this->transactionRepository->create($request->all());

    // Update the account balance based on transaction type
    if ($request->transaction_type === 'Credit') {
        $account->balance += $request->amount;
    } else {
        $account->balance -= $request->amount;
    }
    
    // Save the updated account balance
    $account->save();

    // Redirect back to the account index with a success message
    return redirect()->back()->with('success', 'Transaction successfully recorded!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
