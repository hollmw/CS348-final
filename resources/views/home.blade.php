@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>

        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
                    <p>By: {{ $post->user->name }}</p>
                    
                    {{-- Show views only for admin users --}}
                    @if ($isAdmin)
                        <p><strong>Views:</strong> {{ $post->views }}</p>
                    @endif

                    <h4>Comments:</h4>
                    @forelse ($post->comments as $comment)
                        <div class="mb-2">
                            <p>{{ $comment->content }}</p>
                            <small>By: {{ $comment->user->name }}</small>
                        </div>
                    @empty
                        <p>No comments yet.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
@endsection
