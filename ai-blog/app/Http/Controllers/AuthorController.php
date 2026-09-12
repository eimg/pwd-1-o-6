<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function show(User $user): View
    {
        $posts = $user->posts()
            ->with('category')
            ->withCount('comments')
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('authors.show', compact('user', 'posts'));
    }
}
