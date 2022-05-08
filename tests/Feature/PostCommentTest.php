<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_send_comment()
    {
        $response = $this->post('/post/comment',[
            'user_name' => '',
            'comment' =>  '',
            'post_comment_id' => ''
        ]);
        
        $response->assertStatus(200);
    }
}
