<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Post It</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom Styles */
        body {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: black;
            color: white;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .post-detail {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
        }

        .post-actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .btn-delete,
        .btn-edit {
            background-color: #ff2d20;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            margin-left: 10px;
            cursor: pointer;
            text-decoration: none;
        }

        .post-content {
            text-align: center;
        }

        .post-image img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .post-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .post-info {
            margin-bottom: 20px;
        }

        .post-description {
            line-height: 1.6;
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
    <body >
        @include('header')
        <div >

                        
        <div class="container">
    <div class="post-detail">
        <!-- Post Actions -->
        <div class="post-actions">
            <form method="POST" action="{{ url('post/delete', $getPostRecord->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete Post</button>
            </form>
            <a href="{{ url('edit', $getPostRecord->id) }}" class="btn-edit">Edit Post</a>
        </div>

        <!-- Post Content -->
        <div class="post-content">
            <!-- Image -->
            <div class="post-image">
                @if (filter_var($getPostRecord->image, FILTER_VALIDATE_URL))
                    <img src="{{ $getPostRecord->image }}" alt="Post Image" class="img-fluid">
                @else
                    <img src="{{ asset('images/' . $getPostRecord->image) }}" alt="Post Image" class="img-fluid">
                @endif
            </div>
            
            <!-- View count, author name, category -->
            <div class="post-info">
                <p class="text-primary">Views: {{ $getPostRecord->view_count }} Author: {{ $getUserRecord->name }} Category: {{ $getCategoryRecord->name }}</p>
            </div>
            
            <!-- Title -->
            <h2 class="post-title">{{ $getPostRecord->title }}</h2>
            
            <!-- Description -->
            <p class="post-description">{{ $getPostRecord->description }}</p>
        </div>
    </div>
</div>

    </div>
</div>
    
                            
                            <label>Comments</label>
                            <div id="Comments" class="mt-4 mx-3">
                            @foreach ($getCommentsRecord as $postcomment)
                                <div class="border p-3 mb-3 bg-white text-black">
                                    <p class="mb-1">{{$postcomment->content}}</p>
                                    <p class="mb-1 text-muted">{{$postcomment->created_at}}</p>
                                    <a href="{{ route('profile', ['id' => $postcomment->user_id]) }}"><p class="mb-0">{{ $postcomment->user_name }}</p></a>
                                    <form method="POST" action="{{ route('comment.reply', ['comment' => $postcomment->id, 'postId' => $getPostRecord->id]) }}" class="mt-2">
                                    @csrf
                                    <div class="input-group">
                                        <textarea class="form-control" name="content" placeholder="Reply to this comment"></textarea>
                                        <button type="submit" class="btn btn-sm btn-success">Reply</button>
                                    </div>
                                </form>
                                
                                <!-- Edit button shown only for comments made by authenticated user or admin -->
                                @if ($postcomment->user_id == Auth::id() || Auth::user()->roles()->where('name', 'Admin')->exists())
                                    <button onclick="showEditForm({{ $postcomment->id }})" class="btn btn-sm btn-secondary">Edit</button>
                                    <form id="editForm_{{ $postcomment->id }}" action="{{ route('comment.edit', $postcomment->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group mt-2">
                                            <input type="text" class="form-control" name="content" value="{{ $postcomment->content }}">
                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                        </div>
                                    </form>
                                @endif
                                    <!-- Check if the comment is a parent comment -->
                                    @if ($postcomment->commentable_type == 'Comment' && $postcomment->commentable_id)
                                        <!-- Fetch and display child comments using the commentable_id -->
                                        @foreach ($getCommentsRecord as $childComment)
                                            @if ($childComment->commentable_type == 'Comment'  )
                                                <div class="border p-3 mt-3 bg-light">
                                                    <p class="fw-bold mb-1 text-danger">Replies:</p>
                                                    <div class="border p-3 mb-3 bg-light">
                                                        <p class="mb-1">{{$childComment->content}}</p>
                                                        <p class="mb-1 text-muted">{{$childComment->created_at}}</p>
                                                        <a href="{{ route('profile', ['id' => $childComment->user_id]) }}"><p class="mb-0">{{ $childComment->user_name }}</p></a>
                                                    </div>
                                                    <form method="POST" action="{{ route('comment.reply', ['comment' => $postcomment->id, 'postId' => $getPostRecord->id]) }}" class="mt-2">
                                                        @csrf
                                                        <div class="input-group">
                                                            <textarea class="form-control" name="content" placeholder="Reply to this comment"></textarea>
                                                            <button type="submit" class="btn btn-sm btn-success">Reply</button>
                                                        </div>
                                                    </form>
                                                     <!-- Edit button shown only for comments made by authenticated user or admin -->
                                                    @if ($postcomment->user_id == Auth::id() || Auth::user()->roles()->where('name', 'Admin')->exists())
                                                        <button onclick="showEditForm({{ $postcomment->id }})" class="btn btn-sm btn-secondary">Edit</button>
                                                        <form id="editForm_{{ $postcomment->id }}" action="{{ route('comment.edit', $postcomment->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="input-group mt-2">
                                                                <input type="text" class="form-control" name="content" value="{{ $postcomment->content }}">
                                                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>
                     </div>

            

<form id="commentForm" method="POST" action="{{ url('comment/add', ['id' => $getPostRecord->id, 'commentable_id' => $getPostRecord->id, 'commentable_type' => 'Post']) }}" class="mt-4">
    @csrf
    <div class="input-group mb-3">
        <input id="content" type="text" class="form-control" placeholder="Add a comment" name="content" aria-label="Add a comment" aria-describedby="commentBtn">
        <button class="btn btn-primary" type="submit" id="commentBtn">Comment</button>
    </div>
</form>

<script>
    $(document).ready(function() {
    $('#commentForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function(response) {
                alert('Comment added successfully.');
                window.location.href = '/post/{{ $getPostRecord->id }}';
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Failed to add comment. Please try again.');
            }
        });
    });
});

    /*
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' :$('meta[name="csrf_token"]').attr('content')
        }
    });

    $('#commentForm').on('submit', function(e) {
         var comment = $('#content').val();
         var id = $('#id').val();

         $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {content: comment, _token: '{{csrf_token()}}'},
            url: '/comment/add/' +id,
            success: function(data){
                console.log(data);
            },
            error: function(error){
                console.log(error);
            }
         });
    });
    $(document).ready(function() {
        $('#commentForm').on('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(response) {
            $('#Comments').html('');
            $('#commentSection').html(response.commentSection);
            alert('Comment added successfully.');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Failed to add comment. Please try again.');
        }
    });
});

    });*/

    function showEditForm(commentId) {
        var formId = 'editForm_' + commentId;
        document.getElementById(formId).style.display = 'block';
    }
</script>
        @include('footer')
    </body>
</html>
