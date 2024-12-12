<div class="max-w-4xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">{{ $user->name }}'s Profile</h1>
    
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-3">Posts</h2>
        @forelse ($posts as $post)
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="text-lg font-bold">{{ $post->title }}</h3>
                <p class="text-gray-700 mb-2">{{ $post->content }}</p>
                <small class="text-gray-500">Posted on {{ $post->created_at->format('M d, Y') }}</small>
            </div>
        @empty
            <p class="text-gray-500">No posts yet.</p>
        @endforelse
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-3">Comments</h2>
        @forelse ($comments as $comment)
            <div class="bg-gray-100 p-3 rounded-lg shadow mb-4">
                <p class="text-gray-700">{{ $comment->content }}</p>
                <small class="text-gray-500">
                    On 
                    @if ($comment->post)
                        <a href="{{ route('posts.show', $comment->post->id) }}" class="text-blue-500 underline">
                            {{ $comment->post->title }}
                        </a>
                    @else
                        <span class="text-red-500">Post not found</span>
                    @endif
                    • {{ $comment->created_at->diffForHumans() }}
                </small>

            </div>
        @empty
            <p class="text-gray-500">No comments yet.</p>
        @endforelse
    </div>
</div>
