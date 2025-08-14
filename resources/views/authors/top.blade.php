<!DOCTYPE html>
<html>
<head>
    <title>Top 10 Authors</title>
</head>
<body>
    <h1>Top 10 Authors (Rating > 5)</h1>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Author</th>
                <th>Total Votes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->total_votes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('books.index') }}">Back to Book List</a>
</body>
</html>
