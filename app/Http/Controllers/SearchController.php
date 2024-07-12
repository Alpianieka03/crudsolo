<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Validation to ensure the query is not empty and at least 3 characters long
        $request->validate([
            'query' => 'required|min:3',
        ]);

        // Retrieve the validated search query
        $query = $request->input('query');

        // Search authors by name with pagination
        $authors = Author::where('name', 'LIKE', "%$query%")->paginate(10, ['*'], 'authors_page');

        // Search books by title with pagination
        $books = Book::where('title', 'LIKE', "%$query%")->paginate(10, ['*'], 'books_page');

        // Return the search results to the view
        return view('search.results', compact('authors', 'books', 'query'));
    }
}
