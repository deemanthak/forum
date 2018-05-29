<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function it_has_an_owner()
    {
        $reply=factory('App\Reply')->create();
        $this->assertInstanceOf('App\User',$reply->owner);

    }
}
