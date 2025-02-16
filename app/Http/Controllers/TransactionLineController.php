<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionLineRequest;
use App\Models\TransactionLine;
use Illuminate\Http\Request;

class TransactionLineController extends Controller
{
    public function index(Request $request) // Add Request for filtering
    {
        $transactionLines = TransactionLine::with(['transaction', 'book']) // Eager load relationships
            ->when($request->has('transaction_id'), function ($query) use ($request) {
                $query->where('transaction_id', $request->transaction_id);
            })
            ->paginate(10);

        return view('transaction_lines', compact('transactionLines'));
    }

    public function store(TransactionLineRequest $request)
    {
        TransactionLine::create($request->validated());

        return redirect()->route('transaction_lines.index')->with('success', 'Transaction line created successfully.');
    }

    public function update(TransactionLineRequest $request, TransactionLine $transactionLine)
    {
        $transactionLine->update($request->validated());

        return redirect()->route('transaction_lines.index')->with('success', 'Transaction line updated successfully.');
    }

    public function destroy(TransactionLine $transactionLine)
    {
        $transactionLine->delete();

        return redirect()->route('transaction_lines.index')->with('success', 'Transaction line deleted successfully.');
    }
}
