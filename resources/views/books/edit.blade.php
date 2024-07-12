@extends('layouts.app')

@section('content')
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ $book->title }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="author_id">Author</label>
            <select id="author_id" name="author_id" class="form-control">
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control">
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
