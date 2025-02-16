<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Or paginate: Title::paginate(10);
        return view('books', compact('books')); 
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'nullable|string|max:255',
                'author' => 'nullable|string|max:255',
                'language' => 'nullable|string|max:255',
                'quantity' => 'required|integer|min:0', 
            ]);



            $book = Book::create($validatedData);

            return redirect()->route('books.index')->with('success', 'Book created successfully.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput(); 
        }

    }

    public function update(Request $request, Book $book)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'nullable|string|max:255',
                'author' => 'nullable|string|max:255',
                'language' => 'nullable|string|max:255',
                'quantity' => 'required|integer|min:0', 
            ]);

            $book->update($validatedData);

            return redirect()->route('books.index')->with('success', 'Book updated successfully.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
