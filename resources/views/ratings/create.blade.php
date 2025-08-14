<!DOCTYPE html>
<html>
<head>
    <title>Input Rating</title>
    <script>
        function filterBooks() {
            let authorId = document.getElementById('author').value;
            let books = document.querySelectorAll('.book-option');

            books.forEach(book => {
                book.style.display = (book.dataset.author == authorId) ? 'block' : 'none';
            });
        }
    </script>
</head>
<body>
    <h1>Input Rating</h1>

    <form action="{{ route('ratings.store') }}" method="POST">
        @csrf

        <label>Author:</label>
        <select id="author" onchange="filterBooks()">
            <option value="">Select Author</option>
            @foreach($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select>

        <label>Book:</label>
        <select name="book_id" id="book">
            @foreach($authors as $author)
                @foreach($author->books as $book)
                    <option class="book-option" data-author="{{ $author->id }}" value="{{ $book->id }}" style="display:none;">
                        {{ $book->title }}
                    </option>
                @endforeach
            @endforeach
        </select>

        <label>Rating:</label>
        <select name="rating">
            @for($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <button type="submit">Submit</button>
    </form>

    <a href="{{ route('books.index') }}">Back to Book List</a>
</body>
</html>
