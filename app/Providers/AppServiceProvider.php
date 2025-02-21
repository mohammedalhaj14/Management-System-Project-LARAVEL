<?php

namespace App\Providers;

use App\Models\Classe;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();
        // Route::model('student', User::class);
        Route::model('user', User::class);
        Route::model('classID', Classe::class);
        Route::model('subjectID', Subject::class);
    }
}
