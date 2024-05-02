<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: black;
            color: #1f2937;
        }

        .container {
            max-width: 1140px;
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            object-fit: cover;
            height: 200px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-text {
            color: #4b5563;
        }

        .btn-primary {
            background-color: #ff2d20;
            border-color: #ff2d20;
        }

        .btn-primary:hover {
            background-color: #e11d11;
            border-color: #e11d11;
        }
    </style>
</head>
<body>
    @include('header')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($getRecord as $post)
            <div class="col">
                <div class="card shadow">
                @if (filter_var($post->image, FILTER_VALIDATE_URL))
                    <img src="{{ $post->image }}" alt="Post Image">
                @else
                    <img src="{{ asset('images/' . $post->image) }}" alt="Post Image">
                @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        <a href="{{ url('post', $post->id) }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4 d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item {{ $getRecord->previousPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $getRecord->previousPageUrl() }}">Previous</a>
                </li>
                <li class="page-item disabled"><a class="page-link" href="#">{{ $getRecord->currentPage() }}</a></li>
                <li class="page-item {{ $getRecord->nextPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $getRecord->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@include('footer')
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
