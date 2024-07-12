@extends('layouts.app')

@section('content')
    <h1 >Daftar Lagu</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">tambah</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td><a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a></td>
                    <td>
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Anda yakin ingin menghapusnya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
