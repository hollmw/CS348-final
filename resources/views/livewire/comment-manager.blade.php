<div class="comments-section mt-3">
    <h6 class="text-lg font-semibold mb-4">Comments ({{ $post->comments->count() }})</h6>
    
    @foreach ($post->comments as $comment)
        <div class="bg-gray-100 p-4 rounded-lg mb-3 shadow-sm">
            <p class="mb-2 text-gray-700">{{ $comment->content }}</p>
            <small class="text-sm text-gray-500">
                By 
                <a href="{{ route('users.show', $comment->user->id) }}" class="text-blue-500 underline hover:text-blue-700">
                    {{ $comment->user->name }}
                </a> 
                on {{ $comment->created_at->format('d M Y') }}
            </small>
            
            @if(auth()->check() && (auth()->user()->id === $comment->user_id || auth()->user()->role === 'admin'))
                <div class="flex space-x-4 mt-2">
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?');" class="text-red-500 underline hover:text-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach

    @auth
        <div class="mt-4">
            <form wire:submit.prevent="addComment">
                <div class="mb-3">
                    <textarea wire:model="newComment" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" rows="2" 
                        placeholder="Write a comment..."></textarea>
                    @error('newComment') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Add Comment
                </button>
            </form>
        </div>
    @else
        <p class="text-sm text-gray-500 mt-3">
            <a href="{{ route('login') }}" class="text-blue-500 underline hover:text-blue-700">Login</a> to add a comment.
        </p>
    @endauth
</div>
