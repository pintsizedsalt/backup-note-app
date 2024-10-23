<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Search Results for: "{{ $search }}"</h1>

        @if($notes->isEmpty())
            <p>No notes found matching your search.</p>
        @else
            @foreach ($notes as $note)
                <div class="note">
                    <a href="{{ route('showAll' }}" style="text-decoration: none; color: inherit;">
                        <div style="font-weight: bold; font-size: 20px;">{{$note->title}}</div>
                        <div>{{$note->content}}</div>
                    </a>
                    <hr>
                </div>
            @endforeach
        @endif

        <form action="{{ route('showAll') }}" method="GET">
            <button type="submit" class="btn">Back</button>
        </form>
    </div>
</body>
</html>
