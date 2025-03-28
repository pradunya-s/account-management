<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\AccountRepositoryInterface;

class AccountController extends Controller
{

    private $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = $this->accountRepository->all();

        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create', ['account' => new Account()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_name' => 'required|unique:accounts,account_name',
            'account_type' => 'required|in:Personal,Business',
            'currency' => 'required|in:USD,EUR,GBP',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $this->accountRepository->create($data);
        return redirect()->route('accounts.index')->with('success', 'Account created successfully!');
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
        $account = $this->accountRepository->findById($id);
        return view('accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'account_name' => 'required|unique:accounts,account_name,' . $account->id,
            'account_type' => 'required|in:Personal,Business',
            'currency' => 'required|in:USD,EUR,GBP',
        ]);

        $this->accountRepository->update($account, $request->except(['account_number']));

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        // Delete the account
        $account->delete();

        // Redirect to the accounts list with a success message
        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully!');
    }
    
}
