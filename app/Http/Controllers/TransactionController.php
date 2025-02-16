<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('reader')->paginate(10); 
        return view('transactions', compact('transactions')); 
    }

    public function store(TransactionRequest $request) // Use the request class for validation
    {
        $transaction = Transaction::create($request->validated());

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
