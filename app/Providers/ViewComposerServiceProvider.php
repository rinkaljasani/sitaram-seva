<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Http\ViewComposers\AdminComposer::class);
        $this->app->singleton(\App\Http\ViewComposers\LoginComposer::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $sitesetting = '';
        if(Schema::hasTable('settings')){
            $sitesetting = \App\Models\Setting::pluck('value', 'constant');
        }
        view()->composer(['admin.auth.*'],function($view) use ($sitesetting) {
             $view->with('sitesetting',$sitesetting);
        });
        // view()->composer(['frontend.auth.*'],function($view) use ($sitesetting) {
        //      $view->with('sitesetting',$sitesetting);
        // });
        view()->composer(['admin.pages.*','admin.layouts.*'], 'App\Http\ViewComposers\AdminComposer');
        // view()->composer(['frontend.pages.*','frontend.layouts.*','public.frontend.js.*'], 'App\Http\ViewComposers\UserComposer');
        
    }
}

