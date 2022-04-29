<?php

namespace App\Providers;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\Interfaces\IBaseRepository;
use App\Http\Services\HomeService;
use App\Http\Services\Interfaces\IHome;
use App\Http\Services\Interfaces\IMail;
use App\Http\Services\MailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IBaseRepository::class, BaseRepository::class);
        $this->app->bind(IHome::class, HomeService::class);
        $this->app->bind(IMail::class, MailService::class);
    }
}
