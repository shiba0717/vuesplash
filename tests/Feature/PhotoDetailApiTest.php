<?php

namespace Tests\Feature;

use App\Comment;
use App\Photo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhotoDetailApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function testReturnDetail()
    {

        factory(Photo::class)->create()->each(function ($photo) {
            $photo->comments()->saveMany(factory(Comment::class, 3)->make());
        });
        $photo = Photo::first();

        $response = $this->json('GET', route('photo.show', [
            'id' => $photo->id,
        ]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $photo->id,
                'url' => $photo->url,
                'owner' => [
                    'name' => $photo->owner->name,
                ],
                'liked_by_user' => false,
                'likes_count' => 0,
                'comments' => $photo->comments
                    ->sortByDesc('id')
                    ->map(function ($comment) {
                        return [
                            'author' => [
                                'name' => $comment->author->name,
                            ],
                            'content' => $comment->content,
                        ];
                    })
                    ->all(),
            ]);
    }
}
