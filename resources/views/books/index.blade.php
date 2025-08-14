<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
</head>
<body>
    <h1>List of Books</h1>

    <form method="GET" action="{{ route('books.index') }}">
        <input type="text" name="search" placeholder="Search by book or author" value="{{ request('search') }}">
        <select name="per_page">
            @foreach(range(10, 100, 10) as $num)
                <option value="{{ $num }}" {{ $perPage == $num ? 'selected' : '' }}>{{ $num }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Avg Rating</th>
                <th>Total Votes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ number_format($book->ratings_avg_rating, 2) }}</td>
                    <td>{{ $book->ratings_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $books->links() }}
</body>
</html>
