@extends('layouts.blog')

@section('content')
<article class="article-page container">
    <div class="article-topline"><a href="{{ route('posts.index') }}">← Back to stories</a><span class="mono-label">{{ $post->category->name }}</span></div>
    <div class="article-heading"><p class="eyebrow">{{ $post->created_at->format('F j, Y') }} · {{ $post->comments->count() }} {{ \Illuminate\Support\Str::plural('comment', $post->comments->count()) }}</p><h1>{{ $post->title }}</h1><p class="article-byline">Written by <a class="author-link" href="{{ route('users.show', $post->user) }}"><strong>{{ $post->user->name }}</strong></a></p></div>
    <img src="{{ $post->feature_image }}" alt="" class="article-image">
    <div class="article-layout">
        <div class="article-body">{!! nl2br(e($post->body)) !!}</div>
        <aside class="article-aside">
            @auth
                @if (auth()->id() === $post->user_id)
                    <div class="aside-actions"><a href="{{ route('posts.edit', $post) }}" class="button button-secondary">Edit story</a><form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Delete this story?')">@csrf @method('DELETE')<button class="text-button" type="submit">Delete</button></form></div>
                @endif
            @endauth
            <div class="aside-note"><span class="eyebrow">About this journal</span><p>Ink & Signal is a collection of useful ideas for curious people. Read slowly, take what helps.</p></div>
        </aside>
    </div>

    <section class="comments-section" id="comments">
        <div class="comments-heading"><h2>Conversation</h2><span class="mono-label">{{ $post->comments->count() }} notes</span></div>
        @auth
            <form method="POST" action="{{ route('comments.store', $post) }}" class="comment-form">@csrf<textarea name="content" rows="3" placeholder="Add a thoughtful note…" required>{{ old('content') }}</textarea><div class="form-actions"><span>Posting as {{ auth()->user()->name }}</span><button type="submit" class="button">Add note</button></div></form>
        @else
            <div class="login-prompt"><span>Want to join the conversation?</span><a href="{{ route('login') }}">Log in to comment →</a></div>
        @endauth
        <div class="comment-list">
            @forelse ($post->comments as $comment)
                <div class="comment"><div class="avatar">{{ substr($comment->user->name, 0, 1) }}</div><div class="comment-copy"><div class="comment-meta"><a class="author-link" href="{{ route('users.show', $comment->user) }}"><strong>{{ $comment->user->name }}</strong></a><span>{{ $comment->created_at->diffForHumans() }}</span>@auth @if (auth()->id() === $comment->user_id)<form method="POST" action="{{ route('comments.destroy', $comment) }}">@csrf @method('DELETE')<button class="text-button" type="submit">Remove</button></form>@endif @endauth</div><p>{{ $comment->content }}</p></div></div>
            @empty
                <p class="muted">Be the first to leave a note.</p>
            @endforelse
        </div>
    </section>
</article>
@endsection
