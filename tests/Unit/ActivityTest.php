<?php

namespace Tests\Unit;

use App\Activity;
use function create;
use function factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;
     /** @test */
     public function it_records_when_activity_is_created(){
         $this->signIn();
         $thread = create('App\Thread');
         $this->assertDatabaseHas('activities',[
             'type'=>'created_thread',
             'user_id'=>auth()->id(),
             'subject_id'=>$thread->id,
             'subject_type'=>'App\Thread'

         ]);
         $activity = Activity::first();
         $this->assertEquals($thread->id,$activity->subject->id);
     }

     /** @test */
     function it_records_activity_when_reply_is_created(){
         $this->signIn();

         $reply = create('App\Reply');
            $this->assertEquals(2,Activity::count());
     }
}
