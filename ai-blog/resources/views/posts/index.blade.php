@extends('layouts.blog')

@section('content')
<section class="hero container">
    <p class="eyebrow">Independent ideas, carefully considered</p>
    <h1>Stories for the<br><em>in-between.</em></h1>
    <p class="hero-copy">A quiet corner for notes on making, thinking, and paying attention to the details that shape a good life.</p>
    <form method="GET" action="{{ route('posts.index') }}" class="search-form">
        <label class="sr-only" for="search">Search stories</label>
        <input id="search" name="q" type="search" value="{{ $search }}" placeholder="Search stories, ideas, and authors…" autocomplete="off">
        @if ($activeCategory)
            <input type="hidden" name="category" value="{{ $activeCategory }}">
        @endif
        <button class="search-submit" type="submit">Search <span aria-hidden="true">↗</span></button>
        @if ($search)
            <a class="search-clear" href="{{ route('posts.index', $activeCategory ? ['category' => $activeCategory] : []) }}">Clear</a>
        @endif
    </form>
</section>

<section class="container story-feed">
    <div class="section-bar">
        <div class="category-list">
            <a class="category-pill {{ !$activeCategory ? 'active' : '' }}" href="{{ route('posts.index') }}">All stories</a>
            @foreach ($categories as $category)
                <a class="category-pill {{ $activeCategory === $category->name ? 'active' : '' }}" href="{{ route('posts.index', ['category' => $category->name]) }}">{{ $category->name }}</a>
            @endforeach
        </div>
        <span class="mono-label">{{ $posts->total() }} {{ $search ? 'matching ' : '' }}stories</span>
    </div>

    @if ($posts->count())
        <div class="post-grid">
            @foreach ($posts as $post)
                <article class="post-card {{ $loop->first && !$activeCategory ? 'post-card-featured' : '' }}">
                    <a href="{{ route('posts.show', $post) }}" class="card-image-wrap"><img src="{{ $post->feature_image }}" alt="" class="card-image"></a>
                    <div class="card-content">
                        <div class="meta-row"><a href="{{ route('posts.index', ['category' => $post->category->name]) }}" class="card-category">{{ $post->category->name }}</a><span>{{ $post->created_at->format('M j, Y') }}</span></div>
                        <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                        <p>{{ \Illuminate\Support\Str::limit($post->body, 145) }}</p>
                        <div class="card-footer"><a class="author-link" href="{{ route('users.show', $post->user) }}">By {{ $post->user->name }}</a><span>{{ $post->comments_count }} {{ \Illuminate\Support\Str::plural('comment', $post->comments_count) }}</span></div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="pagination-wrap">
            <p class="results-summary">
                Showing <strong>{{ $posts->firstItem() }}</strong>–<strong>{{ $posts->lastItem() }}</strong> of <strong>{{ $posts->total() }}</strong> stories
            </p>
            <nav class="pagination-nav" aria-label="Stories pagination">
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
        <div class="empty-state"><p>{{ $search ? 'No stories found for “'.$search.'”.' : ($activeCategory ? 'No stories in this category yet.' : 'No stories yet.') }}</p><a href="{{ route('posts.index', $activeCategory ? ['category' => $activeCategory] : []) }}">{{ $search ? 'Clear search' : 'See all stories' }}</a></div>
    @endif
</section>
@endsection
