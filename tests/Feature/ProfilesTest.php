<?php

namespace Tests\Feature;

use function create;
use function factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    /** @test */
    public function a_user_has_a_profile(){
        $user = create('App\User');
        $this->get("/profiles/{$user->name}")->assertSee($user->name);
    }

    /** @test */
    public function profiles_display_all_the_threads_created_by_associated_user(){
        $user = create('App\User');
        $thread = create('App\Thread',['user_id'=>$user->id]);
        $this->get("/profiles/{$user->name}")->assertSee($thread->title)->assertSee($thread->body);
    }


}
