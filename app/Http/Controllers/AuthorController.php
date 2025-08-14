<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function topAuthors()
    {
        $authors = Author::withCount(['books as total_votes' => function($query) {
                $query->join('ratings', 'books.id', '=', 'ratings.book_id')
                      ->where('ratings.rating', '>', 5);
            }])
            ->orderByDesc('total_votes')
            ->take(10)
            ->get();

        info("Top Authors page accessed. Showing top {$authors->count()} authors.");

        return view('authors.top', compact('authors'));
    }
}
