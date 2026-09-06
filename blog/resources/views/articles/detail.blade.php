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
                    {{ $article->created_at }}
                </div>
                <p>
                    {{ $article->body }}
                </p>
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-outline-danger btn-sm">
                    Delete
                </a>
            </div>
        </div>
    </div>
@endsection
