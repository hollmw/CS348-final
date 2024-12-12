<div>
    <form wire:submit.prevent="createPost">
        <div class="mb-3">
            <input type="text" wire:model="title" class="form-control" placeholder="Post Title">
        </div>
        <div class="mb-3">
            <textarea wire:model="content" class="form-control" rows="3" placeholder="Post Content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Post</button>
    </form>

    <div id="posts-list" class="mt-4">
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $post->title }}</h5>
                    <p>{{ $post->content }}</p>
                    <p><strong>By:</strong> {{ $post->user->name }} <strong>On:</strong> {{ $post->created_at->format('d M Y') }}</p>
                    
                    <!-- Comments Display -->
                    <div class="mt-3 ms-4">
                        <h6>Comments:</h6>
                        @foreach($post->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-body py-2">
                                    <p class="mb-1">{{ $comment->content }}</p>
                                    <small class="text-muted">
                                        By {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Comment Form -->
                    @auth
                        <div class="mt-3">
                            <form wire:submit.prevent="addComment({{ $post->id }})">
                                <div class="input-group">
                                    <textarea 
                                        wire:model="newComment.{{ $post->id }}" 
                                        class="form-control form-control-sm" 
                                        rows="1" 
                                        placeholder="Write a comment..."
                                    ></textarea>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
