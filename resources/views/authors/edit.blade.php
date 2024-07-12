@extends('layouts.app')

@section('content')
    <h1>Edit Author</h1>
    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{ $author->name }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-green">Simpan</button>
    </form>
@endsection
