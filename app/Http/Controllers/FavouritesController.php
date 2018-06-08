<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Reply;
use function back;
use function get_class;
use Illuminate\Http\Request;
use function redirect;

class FavouritesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply){
       $reply->favourite();
        return back();
    }
}
