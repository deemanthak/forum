<?php

namespace App\Providers;


use App\Channel;
use Illuminate\Support\ServiceProvider;
use function request;
use function response;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*',function ($view){
            $channels = \Cache::rememberForever('channels',function(){
               return Channel::all();
            });
            $view->with('channels',$channels);
        });

//        \View::composer('*',function ($view){
//            $view->with('popularThreads',request()->);
//        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->isLocal()){
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
