@extends('layouts.app')

@section('content')
    <h1>{{ $author->name }}</h1>
    <h4>Books by {{ $author->name }}</h4>
    @if($author->books->isEmpty())
        <p>This author has not written any books yet.</p>
    @else
        <hr>
       @foreach ($author->books as $book)
            <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
            <br>
        @endforeach
        <hr>
    @endif
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Back</a>
@endsection

