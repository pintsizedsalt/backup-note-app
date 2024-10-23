<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarked Notes</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Bookmarked Notes</h1>
        @foreach ($notes as $note)
            <div class="note">
                <a href="{{ route('showNote', ['id' => $note->id]) }}" style="text-decoration: none; color: inherit;">
                    <div style="font-weight: bold; font-size: 20px;">{{$note->title}}</div>
                    <div class="note-content">{{ $note->content }}</div>
                </a>
                <hr>
            </div>
        @endforeach
        <form action="{{ route('showAll') }}" method="GET" class="create-note-form">
            <button type="submit" class="btn">Back to All Notes</button>
        </form>
    </div>
</body>
</html>

