<?php
/**
 * Created by PhpStorm.
 * User: deemantha
 * Date: 30/5/18
 * Time: 12:43 PM
 */

namespace App\Filters;


use App\User;
use Illuminate\Http\Request;

class ThreadsFilter extends Filters
{
    protected $filters = ['by'];
    /**
     *Filter the threads
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }

}