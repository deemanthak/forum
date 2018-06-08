<?php

namespace App;

use App\Activity;
use function get_class;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use function strtolower;

class Thread extends Model
{

    use RecordsActivity;

    protected $guarded=[];

    protected $with=['channel'];

    protected static function boot(){
        parent::boot();
        static::addGlobalScope('replyCount',function($builder){
            $builder->withCount('replies');
        });
        static::addGlobalScope('creator',function($builder){
            $builder->with('creator');
        });
        static::deleting(function($thread){
           $thread->replies()->delete();
        });

    }

    public function path(){
        return '/threads/'.$this->channel->slug.'/'.$this->id;
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function channel(){
        return $this->belongsTo('App\Channel');
    }

    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function addReply($reply){
        $this->replies()->create($reply);
    }

    public function scopeFilter($query,$filters){
        return $filters->apply($query);
    }

    public function getPopular(){
        return $this->latest()->filter();
    }
}
