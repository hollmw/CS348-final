<div>
    <!-- Post Creation Form -->
    <form wire:submit.prevent="createPost" class="mb-6">
        <div class="mb-3">
            <input type="text" wire:model="title" class="w-full rounded-md border-gray-300" placeholder="Post Title">
        </div>
        <div class="mb-3">
            <textarea wire:model="content" class="w-full rounded-md border-gray-300" rows="3" placeholder="Post Content"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            Add Post
        </button>
    </form>

    <!-- Posts List -->
    <div class="space-y-6">
        @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow">
                <!-- Post Content -->
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $post->content }}</p>
                    <p class="text-sm text-gray-500">
                        Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                    </p>
                    
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <p class="text-sm text-gray-500 mt-2">Views: {{ $post->views ?? 0 }}</p>
                    @endif

                    
                    <div class="mt-6 border-t pt-4">
                        <h3 class="text-lg font-semibold mb-4">Comments</h3>
                        
                        
                        <div class="space-y-4 mb-4">
                            @foreach($post->comments as $comment)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-800 mb-2">{{ $comment->content }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        
                        @auth
                            <form wire:submit.prevent="addComment({{ $post->id }})" class="mt-4">
                                <div class="flex space-x-2">
                                    <textarea 
                                        wire:model="newComment.{{ $post->id }}" 
                                        class="flex-1 rounded-md border-gray-300 text-sm"
                                        rows="1"
                                        placeholder="Write a comment..."
                                    ></textarea>
                                    <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                                        Comment
                                    </button>
                                </div>
                            </form>
                        @else
                            <p class="text-sm text-gray-600 mt-4">
                                Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> to comment.
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
