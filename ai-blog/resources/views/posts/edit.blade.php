@extends('layouts.blog')

@section('content')
<section class="editor-page container"><div class="editor-heading"><p class="eyebrow">Edit story</p><h1>Make it<br><em>even clearer.</em></h1><p>Small refinements can help a good idea travel further.</p></div><form method="POST" action="{{ route('posts.update', $post) }}" class="editor-form">@method('PUT')@include('posts._form', ['submitLabel' => 'Save changes'])</form></section>
@endsection
