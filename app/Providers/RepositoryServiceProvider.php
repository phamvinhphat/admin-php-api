<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repository\Post\PostRepository;
use App\Repository\Post\PostInterface;
class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $toBind = [  // All repositories are registered in this map
            PostInterface::class => PostRepository::class,
        ];

        foreach ($toBind as $interface => $implementation){
            $this->app->bind($interface, $implementation);
        }
    }
}

