<div class="max-w-7xl mx-auto py-6">
    <!-- Post Creation Form -->
    <div class="bg-white p-6 shadow-md rounded-lg mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Create a New Post</h2>
        <form wire:submit.prevent="createPost">
            <div class="mb-4">
                <input
                    type="text"
                    wire:model="title"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                    placeholder="Post Title"
                />
            </div>
            <div class="mb-4">
                <textarea
                    wire:model="content"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                    rows="4"
                    placeholder="Post Content"
                ></textarea>
            </div>
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300"
            >
                Add Post
            </button>
        </form>
    </div>

    <!-- Posts List -->
    <div class="space-y-6">
        @foreach ($posts as $post)
            <div class="bg-white p-6 shadow-md rounded-lg">
                <!-- Post Header -->
                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $post->title }}</h3>
                <p class="text-gray-700 mb-4">{{ $post->content }}</p>
                <p class="text-sm text-gray-500">
                    Posted by 
                    <a href="{{ route('users.show', $post->user->id) }}" class="text-blue-500 underline hover:text-blue-700">
                        {{ $post->user->name }}
                    </a>
                    on {{ $post->created_at->format('M d, Y') }}
                </p>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <p class="text-sm text-gray-500">Views: {{ $post->views ?? 0 }}</p>
                @endif

                <!-- Post Actions -->
                <div class="flex space-x-4 mt-2">
                    @if(auth()->check() && (auth()->user()->id === $post->user_id || auth()->user()->role === 'admin'))
                        <!-- Edit Post -->
                        <a href="{{ route('posts.edit', $post->id) }}" class="text-sm text-blue-500 underline hover:text-blue-700">
                            Edit Post
                        </a>
                        <!-- Delete Post -->
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this post?');" class="text-sm text-red-500 underline hover:text-red-700">
                                Delete Post
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Comments Section -->
                <div class="mt-4 border-t pt-4">
                    <h4 class="text-sm font-semibold text-gray-800 mb-2">Comments</h4>
                    @if ($post->comments->isEmpty())
                        <p class="text-gray-500">No comments yet.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($post->comments as $comment)
                                <div class="bg-gray-50 p-3 rounded-lg shadow-sm">
                                    <p>{{ $comment->content }}</p>
                                    <p class="text-xs text-gray-500">
                                        - 
                                        <a href="{{ route('users.show', $comment->user->id) }}" class="text-blue-500 underline hover:text-blue-700">
                                            {{ $comment->user->name }}
                                        </a>
                                        • {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                    <!-- Comment Actions -->
                                    @if(auth()->check() && (auth()->user()->id === $comment->user_id || auth()->user()->role === 'admin'))
                                        <div class="flex space-x-2 mt-2">
                                            <!-- Edit Comment -->
                                            <a href="{{ route('comments.edit', $comment->id) }}" class="text-xs text-blue-500 underline hover:text-blue-700">
                                                Edit Comment
                                            </a>
                                            <!-- Delete Comment -->
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?');" class="text-xs text-red-500 underline hover:text-red-700">
                                                    Delete Comment
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Add Comment Form -->
                    @auth
                        <form wire:submit.prevent="addComment({{ $post->id }})" class="mt-4">
                            <textarea
                                wire:model="newComment.{{ $post->id }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-green-300 mb-2"
                                rows="2"
                                placeholder="Write a comment..."
                            ></textarea>
                            @error('newComment.'.$post->id)
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            <button
                                type="submit"
                                class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-300"
                            >
                                Add Comment
                            </button>
                        </form>
                    @else
                        <p class="text-sm text-gray-400 mt-3">
                            Please <a href="{{ route('login') }}" class="text-blue-500 underline hover:text-blue-700">login</a> to comment.
                        </p>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
