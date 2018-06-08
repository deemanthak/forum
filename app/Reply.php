<?php

namespace App;

use function auth;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favouritable,RecordsActivity;

    protected $guarded = [];

    protected $with=['owner','favourites'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
