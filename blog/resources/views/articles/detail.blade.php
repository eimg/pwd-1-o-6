@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 600px">

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="card mb-2 bg-white border-primary">
            <div class="card-body">
                <h3 class="card-title">
                    {{ $article->title }}
                </h3>
                <div>
                    <b class="text-success">{{ $article->user->name }}</b>,
                    Category: <b>{{ $article->category->name }}</b>,
                    {{ $article->created_at }}
                </div>
                <p>
                    {{ $article->body }}
                </p>
                
                @auth
                    <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-outline-danger btn-sm">
                        Delete
                    </a>
                @endauth
            </div>
        </div>

        <ul class="mt-4 list-group">
            <li class="list-group-item active">
                Comments ({{ count($article->comments) }})
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    @auth
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    @endauth

                    <b class="text-success">{{ $comment->user->name }}</b> -
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>

        @auth
            <form action="{{ url('/comments/create') }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control my-2"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
        @endauth
    </div>
@endsection
