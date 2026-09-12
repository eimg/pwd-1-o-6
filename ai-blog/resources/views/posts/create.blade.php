@extends('layouts.blog')

@section('content')
<section class="editor-page container"><div class="editor-heading"><p class="eyebrow">New story</p><h1>Put something<br><em>good into the world.</em></h1><p>Write a note, share a point of view, or leave a useful trail for someone else to follow.</p></div><form method="POST" action="{{ route('posts.store') }}" class="editor-form">@include('posts._form', ['submitLabel' => 'Publish story'])</form></section>
@endsection
