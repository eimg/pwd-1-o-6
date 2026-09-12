<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Comment::query()->delete();
        Post::query()->delete();
        Category::query()->delete();
        User::query()->delete();

        $alice = User::create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $bob = User::create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $categories = collect(['Design', 'Technology', 'Culture', 'Business', 'Wellness'])
            ->mapWithKeys(fn (string $name) => [$name => Category::create(['name' => $name])]);

        $stories = [
            ['The quiet power of a well-made morning', 'A thoughtful morning is less about winning the day and more about making room for the ideas that deserve your attention.'],
            ['Designing for the second glance', 'The most memorable interfaces reward curiosity. They reveal just enough at first, then invite you to stay for the details.'],
            ['A field guide to useful curiosity', 'Curiosity becomes useful when it turns observation into a better question, and a better question into a small experiment.'],
            ['Why every team needs a slower hour', 'The fastest teams protect space for reflection. It is where decisions get clearer and busywork loses its disguise.'],
            ['The craft of making technology feel human', 'Good technology fades into the background at the right moment. The goal is not less personality, but more care in every interaction.'],
            ['Notes from a week without notifications', 'Silence is not an empty inbox. It is a chance to notice which thoughts arrive when nobody else is asking for your attention.'],
            ['Small rituals, durable momentum', 'Progress rarely needs a dramatic reset. A repeatable ritual, practiced with patience, often carries us much further.'],
            ['The business case for generous defaults', 'When products assume good intent and make the helpful path obvious, trust becomes part of the experience rather than a feature request.'],
            ['A beginner’s map of digital gardens', 'Digital gardens are not finished shelves. They are living places where half-formed notes can grow into something worth sharing.'],
            ['Making space for the unfinished', 'The pressure to polish everything can keep the best ideas private. Sharing work in progress creates better conversations sooner.'],
            ['What a good workshop leaves behind', 'A workshop matters after the sticky notes come down: in the language a team shares and the next experiment it feels ready to try.'],
            ['The useful tension between taste and data', 'Data can tell us what happened. Taste helps us decide what is worth making next, especially when the future has no dashboard yet.'],
            ['A kinder way to review creative work', 'The strongest feedback is specific enough to act on and generous enough to keep the maker brave.'],
            ['On collecting better questions', 'Answers age quickly. Questions with a little room inside them keep opening doors long after the meeting ends.'],
            ['How neighborhoods teach us to belong', 'Belonging is built from repeated, ordinary gestures: a familiar face, a shared bench, and the feeling that your presence is noticed.'],
            ['The health of an attention budget', 'Attention is a finite resource, and spending it intentionally is one of the quietest forms of self-respect.'],
            ['When a side project becomes a practice', 'A side project gets stronger when it stops being a test of identity and becomes a place to return, learn, and make something real.'],
            ['The long view on tiny improvements', 'A tiny improvement compounds when it is easy to repeat. Over time, consistency becomes a creative advantage.'],
            ['Building a personal reference library', 'The best reference libraries are not collections of everything. They are carefully chosen reminders of how you want to think.'],
            ['A soft landing for ambitious ideas', 'Ambition needs a landing place: a small first version, a welcoming collaborator, and permission to learn in public.'],
        ];

        foreach ($stories as $index => [$title, $body]) {
            $post = Post::create([
                'title' => $title,
                'body' => $body."\n\nThe work becomes clearer when we give it enough time to breathe. Start with one honest observation, make one useful change, and let the next insight arrive from there.",
                'category_id' => $categories->values()->get($index % $categories->count())->id,
                'user_id' => $index % 2 === 0 ? $alice->id : $bob->id,
                'feature_image' => 'https://picsum.photos/seed/ink-signal-'.$index.'/1200/800',
                'created_at' => now()->subDays(20 - $index),
                'updated_at' => now()->subDays(20 - $index),
            ]);

            foreach ([$alice, $bob] as $commenterIndex => $commenter) {
                Comment::create([
                    'content' => [
                        'This gave me a new angle to think about. Thanks for sharing.',
                        'A lovely reminder that small choices shape the larger practice.',
                    ][$commenterIndex],
                    'post_id' => $post->id,
                    'user_id' => $commenter->id,
                    'created_at' => $post->created_at->addHours($commenterIndex + 2),
                    'updated_at' => $post->created_at->addHours($commenterIndex + 2),
                ]);
            }
        }
    }
}
