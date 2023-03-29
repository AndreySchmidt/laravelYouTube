<?php

namespace App\Providers;

// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;
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
        // добавлю слушатель на обращение в БД
        // DB::listen(function ($query){
        //     // выведу все запросы в файл (конфигурация для логирования указана в config/logging.php)
        //     Log::info($query->sql);
        // });
    }
}
