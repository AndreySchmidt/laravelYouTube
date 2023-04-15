<?php

namespace App\Providers;

// sudo ./vendor/bin/sail composer require laravel/sanctum
// sudo ./vendor/bin/sail artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
// sudo ./vendor/bin/sail artisan migrate

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function(object $notifiable, string $url){
            return (new MailMessage)
            ->subject('email verification')
            ->line('some string to body')
            ->action('verifyBtn', $url);
        });
        // auth()->loginUsingId(1);
    }
}
