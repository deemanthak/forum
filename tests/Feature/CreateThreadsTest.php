<?php

namespace Tests\Feature;

use function create;
use function factory;
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

       $response = $this->post('/threads',$thread->toArray());

       $this->get($response->headers->get('Location'))
           ->assertSee($thread->title)
           ->assertSee($thread->body);
   }

   /** @test */
   public function guest_cannot_see_create_thread_page(){
       $this->withExceptionHandling()->get('/threads/create')->assertRedirect('/login');
   }

   /** @test */
   public function a_thread_belongs_to_a_channel(){
       $thread=create('App\Thread');
       $this->assertInstanceOf('App\Channel',$thread->channel);

   }

   /** @test */
   public function a_thread_requires_a_title(){
       $this->publishThread(['title'=>null])
           ->assertSessionHasErrors('title');
   }

    /** @test */
    public function a_thread_requires_a_channel(){
        factory('App\Channel',2)->create();

        $this->publishThread(['channel_id'=>null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id'=>999])
            ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function a_thread_requires_a_body(){
        $this->publishThread(['body'=>null])
            ->assertSessionHasErrors('body');
    }

   public function publishThread($overrides=[]){
       $this->withExceptionHandling()->actingAs(create('App\User'));

       $thread=make('App\Thread',$overrides);

      return $this->post('/threads',$thread->toArray());
   }
}
