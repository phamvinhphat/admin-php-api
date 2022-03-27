<?php

namespace App\Providers;

use App\Repository\IUserRepository;
use App\Repository\IPostIRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\IRoleRepository;
use App\Repository\RoleRepository;
use App\Repository\IPermissionRepository;
use App\Repository\PermissionRepository;
use Illuminate\Support\ServiceProvider;
use function Psy\bin;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPostIRepository::class, PostRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
        $this->app->bind(IPermissionRepository::class,PermissionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
