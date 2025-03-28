<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Create Account
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|unique:accounts,account_name',
            'account_type' => 'required|in:Personal,Business',
            'currency' => 'required|in:USD,EUR,GBP',
            'balance' => 'nullable|numeric|min:0',
            'account_number' => 'required|unique:accounts|regex:/^\d{12,16}$/|luhn',  // Validate Luhn number
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $account = Account::create([
            'account_name' => $request->account_name,
            'account_type' => $request->account_type,
            'currency' => $request->currency,
            'balance' => $request->balance ?? 0,
            'account_number' => $request->account_number,
            'user_id' => auth()->id(),
        ]);

        return response()->json($account, 201);
    }

    // Show Account details
    public function show($account_number)
    {
        $account = Account::where('account_number', $account_number)
            ->where('user_id', auth()->id()) // Ensure only the account owner can access it
            ->first();

        if (!$account) {
            return response()->json(['error' => 'Account not found or unauthorized'], 404);
        }

        return response()->json($account);
    }

    // Update Account
    public function update(Request $request, $account_number)
    {
        $account = Account::where('account_number', $account_number)
            ->where('user_id', auth()->id())
            ->first();

        if (!$account) {
            return response()->json(['error' => 'Account not found or unauthorized'], 404);
        }

        $validator = Validator::make($request->all(), [
            'account_name' => 'required|unique:accounts,account_name,' . $account->id,
            'account_type' => 'required|in:Personal,Business',
            'currency' => 'required|in:USD,EUR,GBP',
            'balance' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $account->update($request->only(['account_name', 'account_type', 'currency', 'balance']));

        return response()->json($account);
    }

    // Deactivate Account
    public function deactivate($account_number)
    {
        $account = Account::where('account_number', $account_number)
            ->where('user_id', auth()->id())
            ->first();

        if (!$account) {
            return response()->json(['error' => 'Account not found or unauthorized'], 404);
        }

        $account->delete();

        return response()->json(['message' => 'Account deactivated successfully']);
    }
}
