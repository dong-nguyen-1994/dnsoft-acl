<?php

namespace Dnsoft\Acl;

use Dnsoft\Acl\Models\Admin;
use Dnsoft\Acl\Repositories\AdminRepositoryInterface;
use Dnsoft\Acl\Repositories\Eloquents\AdminRepository;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(AdminRepositoryInterface::class, function () {
            return new AdminRepository(new Admin());
        });
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'acl');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->mergeConfigFrom(__DIR__.'/../config/acl.php', 'acl');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'acl');
    }
}
