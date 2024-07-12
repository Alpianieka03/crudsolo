@extends('layouts.app')

@section('content')
<h1 class="text-center">Peserta Lomba</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add new</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Image</th>
                <th>Judul</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}</td>
                    <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td>
                    <td>
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" width="100">
                        @endif
                    </td>
                    <td>{{ $book->author->name }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="px-4 py-2 text-black btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 text-black btn btn-danger btn-sm">Delete</button>
                        </form>
                        <form action="{{ route('books.show', $book->id) }}" method="GET" style="display: inline;" onsubmit="return confirm('klik ok');">
                            @csrf
                            @method('SHOW')
                            <button type="submit" class="px-4 py-2 text-black btn btn-success btn-sm">Show</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endsection
