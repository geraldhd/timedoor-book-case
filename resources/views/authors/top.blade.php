<!DOCTYPE html>
<html>
<head>
    <title>Top 10 Authors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>👑 Top 10 Authors (Rating > 5)</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('books.index') }}" class="btn btn-primary">📚 View Books</a>
            <a href="{{ route('ratings.create') }}" class="btn btn-warning">⭐ View Ratings</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Author</th>
                    <th>Total Votes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                    <tr>
                        <td>{{ $author->name }}</td>
                        <td>{{ number_format($author->total_votes) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">No authors found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅ Back to Book List</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
