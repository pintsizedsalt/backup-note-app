<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/datadump.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <nav class="drawer">
        <ul>
            <li><a href="{{ route('showAll') }}" class="nav-link" id="bold"><svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M320-240h320v-80H320v80Zm0-160h320v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z"/></svg> My Notes</a></li>
            <li>
                <a href="{{ route('showBookmarkedNotes') }}" class="nav-link" id="bold">
                    <svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                        <path d="m389-400 91-55 91 55-24-104 80-69-105-9-42-98-42 98-105 9 80 69-24 104ZM200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/>
                    </svg>
                    Bookmarks
                </a>
            </li>
            <li><a href="{{ route('showTrash') }}" class="nav-link" id="bold"><svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>Trash Bin</a></li>
        </ul>
    </nav>

    <div class="container">
        <header class="logo">
            <a href="{{ route('showAll') }}">
                <img src="{{ asset('images/datadump.png') }}" alt="Data Dump Logo" class="logo-img">
            </a>

            <h1>Edit Note</h1>
            <div class="back-home">
            <a href="{{ route('showNote', ['id' => $note->id]) }}" class="home-button"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M760-200v-160q0-50-35-85t-85-35H273l144 144-57 56-240-240 240-240 57 56-144 144h367q83 0 141.5 58.5T840-360v160h-80Z"/></svg>
            </a></div>
        </header>
        
        <main>
            <div class="form-container">
                <form class="form" action="{{ route('updateNote', ['id' => $note->id]) }}" method="POST"> 
                    @method("PUT")
                    @csrf 
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input value="{{ $note->title }}" type="text" id="title" name="title" required class="input-title">
                        <div id="title-error" class="error-message">Title exceeds the maximum characters!</div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input value="{{ $note->description }}" type="text" name="description" id="description" required class="input-description">
                        <div id="description-error" class="error-message">Description exceeds the maximum characters!</div>
                    </div>

                    <div class="form-group"> 
                        <label for="content">Content</label>
                        <textarea id="content" name="content" rows="6" required>{{ $note->content }}</textarea>
                        <<div id="content-error" class="error-message">Content exceeds the maximum characters!</div>
                    </div>

                    <button type="submit" class="form-submit-btn">
                        Save <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </form>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const title = document.getElementById('title');
        const description = document.getElementById('description');
        const content = document.getElementById('content');
        const titleError = document.getElementById('title-error');
        const descriptionError = document.getElementById('description-error');
        const contentError = document.getElementById('content-error');
        const createButton = document.querySelector('.form-submit-btn');

        const maxTitleChars = 60;
        const maxDescriptionChars = 100;
        const maxContentChars = 10000;

        titleError.style.display = 'none';
        descriptionError.style.display = 'none';
        contentError.style.display = 'none';

        const showError = (errorElement) => {
            errorElement.style.display = 'block';
            errorElement.style.opacity = '1';

            setTimeout(() => {
                errorElement.style.opacity = '0'; 
                setTimeout(() => {
                    errorElement.style.display = 'none'; 
                }, 500);
            }, 2000);
        };

        const validateInputs = () => {
            let isValid = true;

            titleError.style.display = 'none';
            descriptionError.style.display = 'none';
            contentError.style.display = 'none';

            if (title.value.length > maxTitleChars) {
                showError(titleError);
                isValid = false;
            }

            if (description.value.length > maxDescriptionChars) {
                showError(descriptionError);
                isValid = false;
            }

            if (content.value.length > maxContentChars) {
                showError(contentError);
                isValid = false;
            }

            return isValid;
        };

        createButton.addEventListener('click', (event) => {
            if (!validateInputs()) {
                event.preventDefault(); 
            }
        });
    });
    </script>
</body>

        <footer class="main-footer">
            <p>© {{ date('Y') }} DataDump | BSIS 2 1st Sem Midterm Project | All Rights Reserved</p>
            <p>Developed by Shandi and Salt</p>
        </footer>
</html>
