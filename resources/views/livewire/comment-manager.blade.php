<div class="comments-section mt-3">
    <h6>Comments ({{ $post->comments->count() }})</h6>
    
    @foreach ($post->comments as $comment)
        <div class="card mb-2">
            <div class="card-body py-2">
                <p class="mb-1">{{ $comment->content }}</p>
                <small class="text-muted">
                    By 
                    <a href="{{ route('users.show', $comment->user->id) }}" class="text-blue-500 underline">
                        {{ $comment->user->name }}
                    </a> 
                    on {{ $comment->created_at->format('d M Y') }}
                </small>
            </div>
        </div>
    @endforeach

    @auth
        <div class="mt-3">
            <form wire:submit.prevent="addComment">
                <div class="form-group">
                    <textarea wire:model="newComment" class="form-control" rows="2" 
                        placeholder="Write a comment..."></textarea>
                    @error('newComment') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
                <button type="submit" class="btn btn-sm btn-primary mt-2">
                    Add Comment
                </button>
            </form>
        </div>
    @else
        <p class="mt-2">
            <a href="{{ route('login') }}">Login</a> to add a comment.
        </p>
    @endauth
</div>
