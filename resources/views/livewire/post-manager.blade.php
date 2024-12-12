<div class="max-w-4xl mx-auto py-6">
    <!-- Post Creation Form -->
    <div class="bg-white p-6 shadow rounded-lg mb-6">
        <h2 class="text-xl font-semibold mb-4">Create a New Post</h2>
        <form wire:submit.prevent="createPost">
            <div class="mb-4">
                <input
                    type="text"
                    wire:model="title"
                    class="w-full border border-gray-300 rounded-lg p-2"
                    placeholder="Post Title"
                />
            </div>
            <div class="mb-4">
                <textarea
                    wire:model="content"
                    class="w-full border border-gray-300 rounded-lg p-2"
                    rows="4"
                    placeholder="Post Content"
                ></textarea>
            </div>
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
                Add Post
            </button>
        </form>
    </div>

    <!-- Posts List -->
    <div class="space-y-6">
        @foreach ($posts as $post)
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-bold mb-2">{{ $post->title }}</h3>
                <p class="text-gray-700 mb-4">{{ $post->content }}</p>
                <p class="text-sm text-gray-500">
                    Posted by <strong>{{ $post->user->name }}</strong> on
                    {{ $post->created_at->format('M d, Y') }}
                </p>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <p class="text-sm text-gray-500">Views: {{ $post->views ?? 0 }}</p>
                @endif

                <!-- Comments Section -->
                <div class="mt-4 border-t pt-4">
                    <h4 class="text-sm font-semibold mb-2">Comments</h4>
                    @if ($post->comments->isEmpty())
                    @else
                        <ul class="space-y-4">
                            @foreach ($post->comments as $comment)
                                <li class="bg-gray-50 p-3 rounded-lg shadow">
                                    <p>{{ $comment->content }}</p>
                                    <p class="text-xs text-gray-500">
                                        - {{ $comment->user->name }} •
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Add Comment Form -->
                    @auth
                        <form
                            wire:submit.prevent="addComment({{ $post->id }})"
                            class="mt-4"
                        >
                            <textarea
                                wire:model="newComment.{{ $post->id }}"
                                class="w-full border border-gray-300 rounded-lg p-2 mb-2"
                                rows="2"
                                placeholder="Write a comment..."
                            ></textarea>
                            <button
                                type="submit"
                                class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700"
                            >
                                Comment
                            </button>
                        </form>
                    @else
                        <p class="text-sm text-gray-400 mt-3">
                            Please <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> to comment.
                        </p>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
