<div class="container py-5">
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h5>Create a New Post</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createPost">
                <div class="mb-3">
                    <input type="text" wire:model="title" class="form-control" placeholder="Post Title">
                </div>
                <div class="mb-3">
                    <textarea wire:model="content" class="form-control" rows="3" placeholder="Post Content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    Add Post
                </button>
            </form>
        </div>
    </div>

    
    <div class="space-y-6">
        @foreach ($posts as $post)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <p class="card-text">{{ $post->content }}</p>
                    <p class="text-muted small mb-1">
                        Posted by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->format('M d, Y') }}
                    </p>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <p class="text-muted small">Views: {{ $post->views ?? 0 }}</p>
                    @endif

                    
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="mb-3">Comments</h6>

                        @if($post->comments->isEmpty())
                            <p class="text-muted">No comments yet. Be the first to comment!</p>
                        @else
                            <div class="mb-3">
                                @foreach($post->comments as $comment)
                                    <div class="card bg-light mb-2">
                                        <div class="card-body py-2">
                                            <p class="card-text mb-1">{{ $comment->content }}</p>
                                            <small class="text-muted">
                                                {{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        
                        @auth
                            <form wire:submit.prevent="addComment({{ $post->id }})" class="mt-3">
                                <div class="input-group">
                                    <textarea 
                                        wire:model="newComment.{{ $post->id }}" 
                                        class="form-control"
                                        rows="1"
                                        placeholder="Write a comment..."
                                    ></textarea>
                                    <button type="submit" class="btn btn-primary">
                                        Comment
                                    </button>
                                </div>
                            </form>
                        @else
                            <p class="small text-muted mt-3">
                                Please <a href="{{ route('login') }}">login</a> to comment.
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>