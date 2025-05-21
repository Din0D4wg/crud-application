<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind('middleware.admin', AdminMiddleware::class);

        $this->app->bind('middleware.student', \App\Http\Middleware\StudentMiddleware::class);

    }
}