<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('books.index');
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        $book = new Book();

        $book->title = $request->title;
        $book->author = $request->author;
        $book->status = $request->status ? 1 : 0;

        $book->user()->associate(Auth::user())->save();

        return redirect()->route('books.index');
    }

    public function edit(Book $book)
    {
        if (Gate::allows('edit.book', $book))
        {
            return view('books.edit', [
                'book' => $book
            ]);
        }
        return redirect()->back();
    }

    public function update(Request $request, Book $book)
    {
        if (Gate::allows('edit.book', $book))
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
            ]);

            $book->title = $request->title;
            $book->author = $request->author;
            $book->status = $request->status ? 1 : 0;

            $book->user()->associate(Auth::user())->save();

            return redirect()->route('books.index');
        }
        return redirect()->back();
    }

    public function destroy(Book $book)
    {
        if (Gate::allows('delete.book', $book))
        {
            $book->delete();
            return redirect()->route('books.index');
        }
        return redirect()->back();
    }
}
