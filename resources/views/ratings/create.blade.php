<!DOCTYPE html>
<html>
<head>
    <title>Input Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function filterBooks() {
            let authorId = document.getElementById('author').value;
            let books = document.querySelectorAll('.book-option');

            books.forEach(book => {
                book.style.display = (authorId && book.dataset.author == authorId) ? 'block' : 'none';
            });
        }
    </script>
</head>
<body class="bg-light p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>⭐ Input Rating</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('books.index') }}" class="btn btn-primary">📚 View Books</a>
            <a href="{{ route('authors.top') }}" class="btn btn-success">👑 View Authors</a>
            <a href="{{ route('ratings.create') }}" class="btn btn-warning">⭐ View Ratings</a>
        </div>
    </div>

    <div class="card shadow rounded-3">
        <div class="card-body">
            <form action="{{ route('ratings.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label for="author" class="form-label fw-bold">Author</label>
                    <select id="author" class="form-select" onchange="filterBooks()" required>
                        <option value="">-- Select Author --</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="book" class="form-label fw-bold">Book</label>
                    <select name="book_id" id="book" class="form-select" required>
                        <option value="">-- Select Book --</option>
                        @foreach($authors as $author)
                            @foreach($author->books as $book)
                                <option class="book-option" data-author="{{ $author->id }}" value="{{ $book->id }}" style="display:none;">
                                    {{ $book->title }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="rating" class="form-label fw-bold">Rating</label>
                    <select name="rating" id="rating" class="form-select" required>
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success w-100">✅ Submit Rating</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅ Back to Book List</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
