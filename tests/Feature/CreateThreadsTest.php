<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function guest_may_not_create_new_forum_thread(){

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');

        $this->post('/threads',$thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }


   /** @test */
   public function an_authenticated_user_can_create_new_forum_thread(){
       $this->actingAs(create('App\User'));

       $thread = make('App\Thread');

       $this->post('/threads',$thread->toArray());

       $this->get($thread->path())
           ->assertSee($thread->title)
           ->assertSee($thread->body);
   }
}