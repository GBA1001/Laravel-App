<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post It</title>
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
    <h2 class="mb-4 row justify-content-center text-white">Posts</h2> 
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($getPostsRecord as $post)
            <div class="col">
                <div class="card shadow">
                    <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="Post Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        <a href="{{ url('post', $post->id) }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4 d-flex justify-content-center">
    </div>
</div>
    <div >
        <h2 class="mb-4 row justify-content-center text-white">Comments</h2> 
        <div id="Comments" class="mt-4">
        @foreach ($getCommentsRecord as $postcomment)
            <div class="border p-3 mb-3 bg-white text-black">
                <p class="mb-1">{{$postcomment->content}}</p>
                <p class="mb-1 text-muted">{{$postcomment->created_at}}</p>
                <p class="mb-0">{{$postcomment->user_name}}</p>
                <!-- Check if the comment is a parent comment -->
                @if ($postcomment->commentable_type == 'Comment' && $postcomment->commentable_id)
                    <!-- Fetch and display child comments using the commentable_id -->
                    @foreach ($getCommentsRecord as $childComment)
                        @if ($childComment->commentable_type == 'Comment' && $childComment->commentable_id == $postcomment->id)
                            <div class="border p-3 mt-3 bg-light">
                                <p class="fw-bold mb-1 text-danger">Replies:</p>
                                <div class="border p-3 mb-3 bg-light">
                                    <p class="mb-1">{{$childComment->content}}</p>
                                    <p class="mb-1 text-muted">{{$childComment->created_at}}</p>
                                    <p class="mb-0">{{$childComment->user_name}}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>

    </div>
    @include('footer')
</body>
</html>
