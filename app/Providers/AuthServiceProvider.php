<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Model::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies(); // ← Pastikan ini hanya dipanggil jika Anda mewarisi class di atas

        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('isUser', function ($user) {
            return strtolower(trim($user->role)) === 'user';
        });

        // Gate::define('isUser', function ($user) {
        //     return $user->role === 'user';
        // });
    }
}
