<?php

namespace Tests\Feature;

use function create;
use function factory;
use function get_class;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use function signIn;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{

    use DatabaseTransactions;
    use DatabaseMigrations;
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

   /** @test */
   public function guest_cannot_delete_threads(){
       $this->withExceptionHandling();
       $thread=create('App\Thread');
       $response = $this->delete($thread->path());
       $response->assertRedirect('/login');
   }

    /** @test */
    public function threads_may_only_be_deleted_by_those_who_have_permission(){
        $this->withExceptionHandling();
        $thread=create('App\Thread');
        $this->delete($thread->path())
            ->assertRedirect('/login');

        $this->actingAs(create('App\User'));
        $this->delete($thread->path())
            ->assertStatus(403);
//            ->assertRedirect('/login');
    }

   /** @test */
   public function athorized_users_thread_can_be_deleted(){
       $this->signIn();
       $thread=create('App\Thread',['user_id'=>auth()->id()]);
       $reply=create('App\Reply',['thread_id'=>$thread->id]);

       $response = $this->json('DELETE',$thread->path());

       $response->assertStatus(204);
       $this->assertDatabaseMissing('threads',['id'=>$thread->id]);
       $this->assertDatabaseMissing('replies',['id'=>$reply->id]);
       $this->assertDatabaseMissing('activities',[
           'subject_id'=>$thread->id,
           'subject_type'=>get_class($thread)
       ]);

       $this->assertDatabaseMissing('activities',[
           'subject_id'=>$reply->id,
           'subject_type'=>get_class($reply)
       ]);

   }



}
