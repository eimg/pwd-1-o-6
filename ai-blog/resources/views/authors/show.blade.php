@extends('layouts.blog')

@section('content')
<section class="author-page container">
    <div class="article-topline"><a href="{{ route('posts.index') }}">← Back to stories</a><span class="mono-label">Author profile</span></div>

    <header class="author-header">
        <div class="author-avatar">{{ substr($user->name, 0, 1) }}</div>
        <div class="author-intro">
            <p class="eyebrow">Writer at ink & signal</p>
            <h1>{{ $user->name }}</h1>
            <p>Sharing useful ideas on making, thinking, and paying attention to the details that shape a good life.</p>
        </div>
        <div class="author-stat"><strong>{{ $posts->total() }}</strong><span>{{ \Illuminate\Support\Str::plural('story', $posts->total()) }}</span></div>
    </header>

    <div class="author-stories-heading">
        <h2>{{ $user->name }}'s stories</h2>
        <span class="mono-label">Latest first</span>
    </div>

    @if ($posts->count())
        <div class="post-grid">
            @foreach ($posts as $post)
                <article class="post-card">
                    <a href="{{ route('posts.show', $post) }}" class="card-image-wrap"><img src="{{ $post->feature_image }}" alt="" class="card-image"></a>
                    <div class="card-content">
                        <div class="meta-row"><a href="{{ route('posts.index', ['category' => $post->category->name]) }}" class="card-category">{{ $post->category->name }}</a><span>{{ $post->created_at->format('M j, Y') }}</span></div>
                        <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                        <p>{{ \Illuminate\Support\Str::limit($post->body, 145) }}</p>
                        <div class="card-footer"><a class="author-link" href="{{ route('users.show', $user) }}">By {{ $user->name }}</a><span>{{ $post->comments_count }} {{ \Illuminate\Support\Str::plural('comment', $post->comments_count) }}</span></div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="pagination-wrap">
            <p class="results-summary">Showing <strong>{{ $posts->firstItem() }}</strong>–<strong>{{ $posts->lastItem() }}</strong> of <strong>{{ $posts->total() }}</strong> stories</p>
            <nav class="pagination-nav" aria-label="{{ $user->name }}'s stories pagination">
                @if ($posts->onFirstPage())
                    <span class="page-link page-link-muted" aria-disabled="true">←<span class="sr-only"> Previous</span></span>
                @else
                    <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev">←<span class="sr-only"> Previous</span></a>
                @endif
                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                    @if ($page == $posts->currentPage())
                        <span class="page-link page-link-current" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
                @if ($posts->hasMorePages())
                    <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next">→<span class="sr-only"> Next</span></a>
                @else
                    <span class="page-link page-link-muted" aria-disabled="true">→<span class="sr-only"> Next</span></span>
                @endif
            </nav>
        </div>
    @else
        <div class="empty-state"><p>{{ $user->name }} has not published any stories yet.</p><a href="{{ route('posts.index') }}">See all stories</a></div>
    @endif
</section>
@endsection
