<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Note</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .input-title {
            width: 300px; 
            max-width: 100%;
        }
        .form-group {
            margin-bottom: 15px; 
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Create Note</h1>
        <form action="{{ route('storeNote')}}" method="POST"> 
            @csrf 
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required class="input-title" style="margin-right: 2px;">
            </div>
            <div class="form-group"> 
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="6" required style="width: 100%;"></textarea>
            </div>
            <div class="button-group">
                <button type="submit" class="btn">Create Note</button>
                <a href="{{ route('showAll') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>
