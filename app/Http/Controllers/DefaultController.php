<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            return redirect()->route('books.index');
        }

        return view('welcome');
    }
}
