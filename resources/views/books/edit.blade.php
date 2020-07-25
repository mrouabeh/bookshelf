@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit book
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.update', $book) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    name="title"
                                    id="title"
                                    value="{{ old('title') ?? $book->title }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Author</label>
                                <input
                                    type="text"
                                    class="form-control @error('author') is-invalid @enderror"
                                    name="author"
                                    id="author"
                                    value="{{ old('author') ?? $book->author }}">
                                @error('author')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-check my-3">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="status"
                                    id="status"
                                    @if($book->status) checked @endif>
                                <label for="status" class="form-check-label">Have you read this book ?</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
