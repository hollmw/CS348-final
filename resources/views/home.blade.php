@extends('layouts.app')

@section('content')
    <livewire:post-manager />

    <div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Forum Posts</h1>
            
            @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <p class="text-muted">Posted by {{ $post->user->name }} at {{ $post->created_at->format('d-m-Y H:i') }}</p>

                        <h6>Comments:</h6>
                        @foreach ($post->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p>{{ $comment->content }}</p>
                                    <p class="text-muted">By {{ $comment->user->name }} at {{ $comment->created_at->format('d-m-Y H:i') }}</p>
                                </div>
                            </div>
                        @endforeach

                        @auth
                        <form method="POST" action="{{ route('comments.store', ['post' => $post->id]) }}">
                            @csrf
                            <textarea name="content" class="form-control" rows="2" placeholder="Write a comment..." required></textarea>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Add Comment</button>
                        </form>
                        @else
                            <p><a href="{{ route('login') }}">Login</a> to add a comment.</p>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
