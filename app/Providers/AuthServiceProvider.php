<?php

namespace selftotten\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use selftotten\Game;
use selftotten\Permission;
use selftotten\Policies\GamePolicies;
use selftotten\Policies\PostPolicy;
use selftotten\Policies\ResultsPolicy;
use selftotten\Policies\UsersPolicy;
use selftotten\Post;
use selftotten\Results;
use selftotten\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Game::class => GamePolicies::class,
        Results::class => ResultsPolicy::class,
        Post::class => PostPolicy::class,
        User::class => UsersPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        foreach ($this->getPermissions() as $permission) {
            $gate->define($permission->name, function ($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }
    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
