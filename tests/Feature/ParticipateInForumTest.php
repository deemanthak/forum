<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test  */
    public function unauthenticated_users_may_not_add_replies()
    {
//        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies',[])
            ->assertRedirect('/login');
    }


    /** @test  */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {

        $this->be(factory('App\User')->create());

        $thread = factory('App\Thread')->create();

        $reply=factory('App\Reply')->create();

        $this->post($thread->path().'/replies',$reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body(){
        $this->withExceptionHandling()->actingAs(create('App\User'));
        $thread=create('App\Thread');
        $reply=make('App\Reply',['body'=>null]);
        $this->post($thread->path().'/replies',$reply->toArray())
           ->assertSessionHasErrors('body');
    }


}
