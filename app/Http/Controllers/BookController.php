<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('author')
            ->withAvg('ratings', 'rating') 
            ->withCount('ratings');        

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                  ->orWhereHas('author', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
        }

        $perPage = $request->get('per_page', 10);
        if (!in_array($perPage, [10,20,30,40,50,60,70,80,90,100])) {
            $perPage = 10;
        }

        $books = $query->orderByDesc('ratings_avg_rating')
                       ->paginate($perPage);

        info("Book list accessed. Search: " . ($request->search ?? 'none') . ", Per page: {$perPage}, Total: {$books->total()}");

        return view('books.index', compact('books', 'perPage'));
    }
}
