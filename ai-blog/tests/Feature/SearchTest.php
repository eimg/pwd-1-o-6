<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_stories_can_be_searched_by_title(): void
    {
        $author = User::factory()->create(['name' => 'Alice']);
        $category = Category::create(['name' => 'Design']);

        Post::create([
            'title' => 'The quiet power of focus',
            'body' => 'A sufficiently long story body about focus and attention.',
            'category_id' => $category->id,
            'user_id' => $author->id,
            'feature_image' => 'https://picsum.photos/seed/focus/1200/800',
        ]);
        Post::create([
            'title' => 'A field guide to workshops',
            'body' => 'A sufficiently long story body about making space for teams.',
            'category_id' => $category->id,
            'user_id' => $author->id,
            'feature_image' => 'https://picsum.photos/seed/workshops/1200/800',
        ]);

        $response = $this->get(route('posts.index', ['q' => 'focus']));

        $response->assertOk();
        $response->assertSee('The quiet power of focus');
        $response->assertDontSee('A field guide to workshops');
        $response->assertSee('1 matching stories');
    }
}
