<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📚 List of Books</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('authors.top') }}" class="btn btn-info">👤 View Authors</a>
            <a href="{{ route('ratings.create') }}" class="btn btn-warning">⭐ View Ratings</a>
        </div>
    </div>

    <form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" 
                   placeholder="Search by book or author" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="per_page" class="form-select">
                @foreach(range(10, 100, 10) as $num)
                    <option value="{{ $num }}" {{ $perPage == $num ? 'selected' : '' }}>
                        {{ $num }} / page
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('books.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Avg Rating</th>
                    <th>Total Votes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ number_format($book->ratings_avg_rating, 2) }}</td>
                        <td>{{ $book->ratings_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No books found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            {{ $books->links('pagination::bootstrap-5') }}
        </div>
        <div class="d-flex gap-2">
            @if ($books->previousPageUrl())
                <a href="{{ $books->previousPageUrl() }}" class="btn btn-outline-primary">⬅ Previous Page</a>
            @endif

            @if ($books->nextPageUrl())
                <a href="{{ $books->nextPageUrl() }}" class="btn btn-outline-primary">Next Page ➡</a>
            @endif
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
