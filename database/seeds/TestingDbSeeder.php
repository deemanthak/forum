<?php

use Illuminate\Database\Seeder;

class TestingDbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=factory('App\User')->create(['email'=>'dee@dee.com','password'=>bcrypt('aaaaaa')]);
        $threads = factory('App\Thread',50)->create();

        $threads->each(function($thread){
            factory('App\Reply',10)->create(['thread_id'=>$thread->id]);
        });
    }
}
