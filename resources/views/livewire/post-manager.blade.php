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
                </div>
            </div>
        @endforeach
    </div>
</div>