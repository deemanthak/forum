<?php
/**
 * Created by PhpStorm.
 * User: deemantha
 * Date: 6/6/18
 * Time: 10:59 AM
 */

namespace App;


trait Favouritable
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favourites()
    {
        return $this->morphMany('App\Favourite', 'favourited');

    }

    /**
     *
     */
    public function favourite()
    {

        $attributes = ['user_id' => auth()->id()];
        if (!$this->favourites()->where($attributes)->exists()) {
            $this->favourites()->create($attributes);
        }
    }

    /**
     * @return mixed
     */
    public function isFavourited()
    {
        return $this->favourites->where('user_id', auth()->id())->count();
    }

    /**
     * @return mixed
     */
    public function getFavouritesCountAttribute()
    {
        return $this->favourites->count();
    }
}