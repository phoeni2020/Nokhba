<?php

namespace App\Providers;

use App\Models\Teachers;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $teacher = Teachers::all();
        return view()->share(['teachers'=>$teacher]);
    }
}
