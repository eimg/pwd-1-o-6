<div>
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
</div>
@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 600px">
        <form action="{{ url("/articles/create") }}" method="post">
            @csrf
            <input type="text" class="form-control mb-2" name="title" placeholder="Title">
            <textarea name="body" placeholder="Body" class="form-control mb-2"></textarea>
            <select name="category_id" class="form-select mb-2">
                <option value="1">News</option>
                <option value="2">Tech</option>
            </select>

            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>
@endsection
