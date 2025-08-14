<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function create()
    {
        $authors = Author::with('books')->get();
        return view('ratings.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);
    
        $rating = Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);
        $book = Book::find($request->book_id);
        info("New rating created: Book '{$book->title}' (ID: {$book->id}), Rating: {$request->rating}");
    
        return redirect()->route('books.index')->with('success', 'Rating berhasil ditambahkan');
    }
    
}

