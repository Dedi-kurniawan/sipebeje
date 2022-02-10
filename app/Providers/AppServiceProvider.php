<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        view()->composer('layouts.backend.partials.header', function ($view) {
            $user = User::find(Auth::user()->id);
            $countnotifikasi = count($user->unreadNotifications);
            return $view->with('user', $user)->with('countnotifikasi', $countnotifikasi);
        });
    }
}
