<?php
/**
 * Created by PhpStorm.
 * User: deemantha
 * Date: 30/5/18
 * Time: 11:10 AM
 */

namespace Tests\Unit;

use function create;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_channel_consists_of_threads(){
//        $channel = create('App\Channel');
//        $thread = create('App\Thread',['channel_id'=>$channel->id]);
//        $this->assertTrue($channel->threads->contatins($thread));
$this->assertTrue(true);
    }
}