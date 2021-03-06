<?php

namespace App\Providers;

use App\Models\Footer;
use App\Models\Portfolio;
use App\Models\SocialIcons;
use Illuminate\Support\ServiceProvider;

class FooterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.frontendapp', function ($view) {
            $view->with('footer', Footer::first())->with('portfolio', Portfolio::first())->with('socialLinks', SocialIcons::where('status', true)->toBase()->get());;
        });
        view()->composer('frontend.index', function ($view) {
            $view->with('footer', Footer::first());
        });


        view()->composer('layouts.blogapp', function ($view) {
            $view->with('footer', Footer::first())->with('portfolio', Portfolio::first())->with('socialLinks', SocialIcons::where('status', true)->toBase()->get());;
        });
    }
}
