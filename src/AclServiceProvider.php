<?php

namespace Dnsoft\Acl;

use Dnsoft\Acl\Contracts\PermissionManagerInterface;
use Dnsoft\Acl\Models\Admin;
use Dnsoft\Acl\Repositories\AdminRepositoryInterface;
use Dnsoft\Acl\Repositories\Eloquents\AdminRepository;
use Dnsoft\Acl\Supports\PermissionManager;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Dnsoft\Acl\Http\Middleware\AdminAuth;

class AclServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton(AdminRepositoryInterface::class, function () {
            return new AdminRepository(new Admin());
        });

        $this->loadPermission();
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'acl');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->mergeConfigFrom(__DIR__.'/../config/acl.php', 'acl');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'acl');

        $this->registerMiddleware();

        $this->app->singleton(PermissionManagerInterface::class, PermissionManager::class);

    }

    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
    }

    protected function loadPermission()
    {
        //Gate::define('');
    }
}
