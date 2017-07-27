<?php namespace Ikas\Parser;

use Illuminate\Support\Facades\Route;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        Route::get('cleanup_posts', function(){ return Posts::cleanUp(); });
    }

}
