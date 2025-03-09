<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Redirect an Authenticated User Dashboard
        RedirectIfAuthenticated::redirectUsing(function(){
            return route('admindashboard');
        });

        //Redirect an Authenticated User to admin login page
        Authenticate::redirectUsing(function(){
            Session::flash('fail','You must be logged in to access admin area. Please login to continue.');
            return route('adminlogin');
        });
    }
}