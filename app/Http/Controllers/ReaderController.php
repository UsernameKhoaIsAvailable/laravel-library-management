<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReaderController extends Controller
{
    public function index()
    {
        $readers = Reader::all(); // Or paginate: Reader::paginate(10);
        return view('readers', compact('readers')); // Create a view named index.blade.php
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'dob' => 'required|date',
            'id_number' => ['required', 'string', 'unique:readers', 'max:20'], // Unique ID
            'address' => 'nullable|string',
            'number_of_books_borrowed' => 'nullable|integer',
        ]);

        Reader::create($validatedData);

        return redirect()->route('readers.index')->with('success', 'Reader created successfully!');
    }

    public function update(Request $request, Reader $reader)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'dob' => 'required|date',
            'id_number' => ['required', 'string', Rule::unique('readers')->ignore($reader->id), 'max:20'], // Unique, except for current reader
            'address' => 'nullable|string',
            'number_of_books_borrowed' => 'nullable|integer',
        ]);

        $reader->update($validatedData);

        return redirect()->route('readers.index')->with('success', 'Reader updated successfully!');
    }

    public function destroy(Reader $reader)
    {
        $reader->delete();

        return redirect()->route('readers.index')->with('success', 'Reader deleted successfully!');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $readers = Reader::simpleSearch($search)->get();
        return view('readers', compact('readers'));
    }
}
