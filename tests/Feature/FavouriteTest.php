<?php

namespace Tests\Feature;

use function create;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavouriteTest extends TestCase
{


    use DatabaseTransactions;

    /** @test */
    public function guest_cannot_favourite_any_reply()
    {

        $this->withExceptionHandling()->post('/replies/1/favourites')->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favourite_any_reply()
    {

        $this->actingAs(create('App\User'));
        $reply = create('App\Reply');

        $this->post('/replies/' . $reply->id . '/favourites');
        $this->assertCount(1, $reply->favourites);
    }

    /** @test */
    public function an_authenticated_user_can_favourite_any_reply_once()
    {
        $this->actingAs(create('App\User'));
        $reply = create('App\Reply');
        $reply2 = create('App\Reply');
        try {

            $this->post('/replies/' . $reply->id . '/favourites');
            $this->post('/replies/' . $reply->id . '/favourites');
            $this->post('/replies/' . $reply2->id . '/favourites');
        } catch (\Exception $e) {
            $this->fail('Cannot favourite same reply more than one time');
        }
        $this->assertCount(1, $reply->favourites);
    }
}
