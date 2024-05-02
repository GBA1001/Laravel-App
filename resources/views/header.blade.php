<div class="text-center py-1 bg-danger text-white">
    <h1>Post It</h1>
</div>
<header class="navbar navbar-expand-lg navbar-light bg-light" style="padding-top: 0; padding-bottom: 0;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('post.list') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('create') }}">Create Post</a>
                </li>
            </ul>
            @if(session()->has('user'))
                <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
            @else
                <p>User information not available</p>
            @endif
        </div>
    </div>
</header>
