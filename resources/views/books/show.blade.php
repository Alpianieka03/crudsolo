@extends('layouts.app')

@section('content')
    <h1>{{ $book->title }}</h1>
    @if($book->image)
        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" width="200">
    @endif
    <p>by {{ $book->author->name }}</p>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
@endsection

