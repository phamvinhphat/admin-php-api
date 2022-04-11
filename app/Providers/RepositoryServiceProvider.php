<?php

namespace App\Providers;

use App\Repository\IUserRepository;
use App\Repository\IPostRepository;
use App\Repository\IWorkflowRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\IRoleRepository;
use App\Repository\RoleRepository;
use App\Repository\IPermissionRepository;
use App\Repository\PermissionRepository;
use App\Repository\PermissionRoleRepository;
use App\Repository\IPermissionRoleRepository;
use App\Repository\DocumentRepository;
use App\Repository\IDocumentRepository;
use App\Repository\IStatusRepository;
use App\Repository\StatusRepository;
use App\Repository\WorkflowRepository;
use Illuminate\Support\ServiceProvider;
use PhpParser\Comment\Doc;
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
                IPostRepository::class => PostRepository::class,
                IRoleRepository::class => RoleRepository::class,
                IPermissionRepository::class => PermissionRepository::class,
                IPermissionRoleRepository::class => PermissionRoleRepository::class,
                IStatusRepository::class => StatusRepository::class,
                IDocumentRepository::class => DocumentRepository::class,
                IWorkflowRepository::class => WorkflowRepository::class,
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
