<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post It</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <style>
        /* Custom Styles */
        body {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: black; /* Set background color to a light shade */
            color: #1f2937;
        }

        .container {
            max-width: 800px; /* Limit the width of the container */
            margin-top: 100px; /* Center the container vertically */
        }

        form {
            padding: 20px; /* Add some padding to the form */
            border-radius: 10px; /* Add border radius to the form */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box shadow for depth */
            background-color: #ffffff; /* Set background color to white */
        }

        /* Style for the text editing plugin */
        .text-editor {
            height: 200px; /* Set height for the text editor */
            padding: 10px; /* Add padding to the text editor */
            border: 1px solid #ced4da; /* Add border */
            border-radius: 5px; /* Add border radius */
            resize: vertical; /* Allow vertical resizing */
        }
    </style>
</head>
<body>
<script>
    $(document).ready(function() {
        $('#content').summernote({
            placeholder: 'Enter Content',
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });
    });
</script>

@include('header')

<div class="container">
    <main>
        <h2 class="mb-4 row justify-content-center text-white">Edit Post</h2> <!-- Changed heading to Edit Post -->
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <form method="POST" action="{{ url('post/update', $getPostRecord->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating the post -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input id="title" name="title" type="text" class="form-control" placeholder="Enter Title" value="{{ $getPostRecord->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <!-- Description input -->
                        <input id="description" name="description" type="text" class="form-control" placeholder="Enter Description" value="{{ $getPostRecord->description }}">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <!-- Content textarea with text editing plugin -->
                        <textarea id="content" name="content" class="form-control text-editor" placeholder="Enter Content">{{ $getPostRecord->content }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <!-- Show the existing image -->
                        <img src="{{ asset('images/'.$getPostRecord->image) }}" alt="Post Image">
                        <!-- Allow changing the image -->
                        <input id="image" name="image" type="file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input id="category" name="category" type="text" class="form-control" placeholder="Enter Category" value="{{ $getPostRecord->category_name }}">
                    </div>
                    <button type="submit" class="btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        <p>Footer</p>
    </footer>
</div>

@include('footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
