<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Paginate the books with 10 items per page
        $books = Book::with('author')->paginate(5);
        
        // Return the view with the paginated books
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        Book::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'image' => $path,
        ]);

        return redirect()->route('books.index')->with('success', 'song created successfully!');
    }

    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $book = Book::findOrFail($id);

        $path = $book->image;
        if ($request->hasFile('image')) {
            if ($path) {
                \Storage::delete('public/' . $path);
            }
            $path = $request->file('image')->store('images', 'public');
        }

        $book->update([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'image' => $path,
        ]);

        return redirect()->route('books.index')->with('success', 'song updated successfully!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->image) {
            \Storage::delete('public/' . $book->image);
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'song deleted successfully!');
    }
    
    
    
}
