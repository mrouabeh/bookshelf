<?php

namespace App\Providers;

use App\Book;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit.book', function($user, Book $book) {
            return ($book->user->id == $user->id);
        });

        Gate::define('delete.book', function($user, Book $book) {
            return ($book->user->id == $user->id);
        });
    }
}
