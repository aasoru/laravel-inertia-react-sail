<?php

namespace App\Providers;

use League\Glide\Server;
use League\Glide\ServerFactory;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        JsonResource::withoutWrapping();
    }

    public function register()
    {
        $this->registerGlide();
    }

    protected function registerGlide()
    {
        $this->app->bind(ServerFactory::class, function ($app) {
            return ServerFactory::create([
                'source' => Storage::getDriver(),
                'cache' => Storage::getDriver(),
                'cache_folder' => '.glide-cache',
                'base_url' => 'img',
            ]);
        });
    }

}
