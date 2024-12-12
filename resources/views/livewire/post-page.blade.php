<div class="max-w-4xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
    <p class="text-gray-700 mb-6">{{ $post->content }}</p>
    <small class="text-gray-500">
        Posted by 
        <a href="{{ route('users.show', $post->user->id) }}" class="text-blue-500 underline">
            {{ $post->user->name }}
        </a>
        on {{ $post->created_at->format('M d, Y') }}
    </small>
</div>
