<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->string('category')->toString();
        $search = trim($request->string('q')->toString());

        $posts = Post::query()
            ->with(['user', 'category'])
            ->withCount('comments')
            ->when($category, fn ($query) => $query->whereHas('category', fn ($categories) => $categories->where('name', $category)))
            ->when($search, function ($query) use ($search) {
                $like = "%{$search}%";

                $query->where(function ($searchQuery) use ($like) {
                    $searchQuery
                        ->where('title', 'like', $like)
                        ->orWhere('body', 'like', $like)
                        ->orWhereHas('category', fn ($categories) => $categories->where('name', 'like', $like))
                        ->orWhereHas('user', fn ($users) => $users->where('name', 'like', $like));
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => Category::query()->orderBy('name')->get(),
            'activeCategory' => $category,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('posts.create', ['categories' => Category::query()->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:20'],
            'category_id' => ['required', 'exists:categories,id'],
            'feature_image' => ['nullable', 'url', 'max:2048'],
        ]);

        $data['user_id'] = $request->user()->id;
        $data['feature_image'] ??= 'https://picsum.photos/seed/'.Str::random(8).'/1200/800';
        $post = Post::create($data);

        return redirect()->route('posts.show', $post)->with('success', 'Your story is live.');
    }

    public function show(Post $post): View
    {
        $post->load(['user', 'category', 'comments.user']);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        abort_unless($post->user_id === auth()->id(), 403);

        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        abort_unless($post->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:20'],
            'category_id' => ['required', 'exists:categories,id'],
            'feature_image' => ['nullable', 'url', 'max:2048'],
        ]);

        $post->update($data);

        return redirect()->route('posts.show', $post)->with('success', 'Story updated.');
    }

    public function destroy(Request $request, Post $post): RedirectResponse
    {
        abort_unless($post->user_id === $request->user()->id, 403);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Story deleted.');
    }
}
