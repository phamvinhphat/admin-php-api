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
use App\Repository\PermissionRoleRepository;
use App\Repository\IPermissionRoleRepository;
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
            $toBind = [
                IUserRepository::class => UserRepository::class,
                IPostIRepository::class => PostRepository::class,
                IRoleRepository::class => RoleRepository::class,
                IPermissionRepository::class => PermissionRepository::class,
                IPermissionRoleRepository::class => PermissionRoleRepository::class,
            //    IUserRepository::class => PermissionRepository::class,
            ];

            foreach ($toBind as $interface => $implementation){
                $this->app->bind($interface, $implementation);
            }
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
