@extends('layouts.app')

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>

    <h2>Authors</h2>
    @if($authors->isEmpty())
        <p>No authors found.</p>
    @else
        <ul>
            @foreach ($authors as $author)
                <li><a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a></li>
            @endforeach
        </ul>
        <!-- Pagination links for authors -->
        {{ $authors->appends(['query' => $query, 'books_page' => $books->currentPage()])->links() }}
    @endif

    <h2>Books</h2>
    @if($books->isEmpty())
        <p>No books found.</p>
    @else
        <ul>
            @foreach ($books as $book)
                <li><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a> by {{ $book->author->name }}</li>
            @endforeach
        </ul>
        <!-- Pagination links for books -->
        {{ $books->appends(['query' => $query, 'authors_page' => $authors->currentPage()])->links() }}
    @endif
@endsection
