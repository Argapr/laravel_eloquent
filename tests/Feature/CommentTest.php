<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testCreateComment()
    {
        $comment = new Comment();
        $comment->email = "arga@gmail.com";
        $comment->title = "Sample Title";
        $comment->comment = "Sample Comment";

        $comment->save();

        self::assertNotNull($comment->id);
    }

//    S: Default Attribute Value
    public function testDefaultAttributesValues()
    {
        $comment = new Comment();
        $comment->email = "arga@gmail.com";

        $comment->save();

        self::assertNotNull($comment->id);
        self::assertNotNull($comment->title);
        self::assertNotNull($comment->comment);
    }
//    E: Default Attribute Value
}
