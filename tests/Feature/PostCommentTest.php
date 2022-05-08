<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Tests\TestCase;

class PostCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_send_empty_value_comment()
    {
        $response = $this->post('/post/comment',[
            'user_name' => '',
            'comment' =>  '',
            'post_comment_id' => null
        ]);
        //dd($response);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['user_name','comment']);
    }

    public function test_send_comment()
    {
        $user_name= 'test';
        $comment = 'comment test text';
        $response = $this->post('/post/comment',[
            'user_name' => $user_name,
            'comment' =>  $comment,
            'post_comment_id' => null
        ]);

        $response->assertStatus(200);
        $json = json_decode($response->getContent(),true);
        if(array_key_exists('id',$json) && $json['user_name']== $user_name && $json['comment']==$comment)
            $this->assertTrue(true);
        else
            $this->assertFalse(false);



    }

    public function test_send_comment_reply()
    {
        $user_name= 'test reply';
        $comment = 'reply test text';
        $response = $this->post('/post/comment',[
            'user_name' => $user_name,
            'comment' =>  $comment,
            'post_comment_id' => 1
        ]);

        $response->assertStatus(200);

        $json = json_decode($response->getContent(),true);
        if(json_last_error() === JSON_ERROR_NONE && array_key_exists('id',$json[0]))
            $this->assertTrue(true);
        else
            $this->assertFalse(false);

    }
}
