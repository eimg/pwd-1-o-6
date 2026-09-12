<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_author_profile_displays_the_authors_posts(): void
    {
        $author = User::factory()->create(['name' => 'Alice']);
        $category = Category::create(['name' => 'Design']);
        $post = Post::create([
            'title' => 'A thoughtful story',
            'body' => 'This is a sufficiently long story body for the profile test.',
            'category_id' => $category->id,
            'user_id' => $author->id,
            'feature_image' => 'https://picsum.photos/seed/profile-test/1200/800',
        ]);

        $response = $this->get(route('users.show', $author));

        $response->assertOk();
        $response->assertSee('Alice');
        $response->assertSee('A thoughtful story');
        $response->assertSee(route('posts.show', $post));
    }

    public function test_post_cards_link_the_author_name_to_the_profile(): void
    {
        $author = User::factory()->create(['name' => 'Bob']);
        $category = Category::create(['name' => 'Technology']);
        Post::create([
            'title' => 'A useful idea',
            'body' => 'This is a sufficiently long story body for the homepage test.',
            'category_id' => $category->id,
            'user_id' => $author->id,
            'feature_image' => 'https://picsum.photos/seed/home-test/1200/800',
        ]);

        $response = $this->get(route('posts.index'));

        $response->assertOk();
        $response->assertSee(route('users.show', $author));
        $response->assertSee('By Bob');
    }
}
