<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionLineRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\Book;
use App\Models\Reader;
use App\Models\Transaction;
use App\Models\TransactionLine;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('reader')->orderBy('is_completed', 'asc')->orderBy('borrow_date', 'desc')->paginate(10);
        $readers = Reader::orderBy('name', 'asc')->pluck('id', 'name');
        $books = Book::where('quantity', '>', 0)->orderBy('name', 'asc')->pluck('id', 'name');
        return view('transactions', compact('transactions', 'readers', 'books'));
    }

    public function store(TransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());
        $selectedBookIds = $request->input('books');
        $transaction->number_of_transaction_lines = count($selectedBookIds);
        $transaction->save();
        for ($i = 0; $i < count($selectedBookIds); $i++) {
            $transaction->transactionLines()->create([
                'book_id' => $selectedBookIds[$i],
            ]);
            $book = Book::find($selectedBookIds[$i]);
            $book->decrement('quantity', 1);
        }
        $transaction->reader->increment('number_of_books_borrowed', count($selectedBookIds));
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function updatee(TransactionLineRequest $request)
    {
        foreach ($request->lines as $lineId) {
            $transactionLine = TransactionLine::find($lineId);
            $transactionLine->is_completed = true;
            $transactionLine->save();
            $transactionLine->transaction->reader->decrement('number_of_books_borrowed', 1);
            $transactionLine->book()->increment('quantity', 1);
        }
        $transaction = TransactionLine::find($request->lines[0])->transaction;
        $transactionLines = $transaction->transactionLines;
        if (
            $transactionLines->every(function ($transactionLine) {
                return $transactionLine->is_completed === true;
            })
        ) {
            $transaction->is_completed = true;
            $transaction->save();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction line updated successfully.');
    }
}
