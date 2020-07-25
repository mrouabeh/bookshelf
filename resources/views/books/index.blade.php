@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Books</h1>
        </div>
    </div>

    <div class="row justify-content-center my-4">
        <div class="col-md-10">
            <a class="btn btn-primary" href="{{ route('books.create') }}">+ Add book</a>
        </div>
    </div>

    <div class="row justify-content-center my-4">
        <div class="col-md-10">
            @if(Auth::user()->books()->exists())
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Auth::user()->books()->get() as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>
                                <span class="badge {{ $book->status ? "badge-success" : "badge-secondary" }}">
                                    {{ $book->status ? "read" : "unread" }}
                                </span>
                            </td>
                            <td style="width: 25%">
                                <form action="{{ route('books.destroy', $book) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary mx-2" href="{{ route('books.edit', $book) }}">Edit</a>
                                    <button class="btn btn-danger mx-2" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="card">
                <div class="card-body">
                    Nothing here
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
