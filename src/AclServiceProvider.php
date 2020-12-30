<?php

namespace Dnsoft\Acl;

use Dnsoft\Acl\Contracts\PermissionManagerInterface;
use Dnsoft\Acl\Events\AclAdminMenuRegistered;
use Dnsoft\Acl\Facades\Permission;
use Dnsoft\Acl\Http\Middleware\AdminPermission;
use Dnsoft\Acl\Http\Middleware\RedirectIfAdminAuth;
use Dnsoft\Acl\Models\Admin;
use Dnsoft\Acl\Models\Role;
use Dnsoft\Acl\Repositories\AdminRepositoryInterface;
use Dnsoft\Acl\Repositories\Eloquents\AdminRepository;
use Dnsoft\Acl\Repositories\Eloquents\RoleRepository;
use Dnsoft\Acl\Repositories\RoleRepositoryInterface;
use Dnsoft\Core\Events\CoreAdminMenuRegistered;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Dnsoft\Acl\Http\Middleware\AdminAuth;

class AclServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(AdminRepositoryInterface::class, function () {
            return new AdminRepository(new Admin());
        });

        $this->app->singleton(RoleRepositoryInterface::class, function () {
            return new RoleRepository(new Role());
        });

        $this->registerPermissions();
        $this->registerAdminMenu();
        $this->registerBladeDirectives();

        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/auth.php');

        require_once __DIR__. '/../helpers/helpers.php';
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'acl');

        $this->mergeConfigFrom(__DIR__.'/../config/acl.php', 'acl');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'acl');

        $this->registerMiddleware();
        $this->registerConfigData();

        $this->app->singleton(PermissionManagerInterface::class, PermissionManager::class);

    }

    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
        $router->aliasMiddleware('admin.can', AdminPermission::class);
        $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
    }

    protected function registerConfigData()
    {
        $aclConfigData = include __DIR__ .'/../config/acl.php';
        $authConfig = $this->app['config']->get('auth');
        $auth = array_merge_recursive_distinct($aclConfigData['auth'], $authConfig);
        $this->app['config']->set('auth', $auth);
    }

    protected function registerPermissions()
    {
        Permission::add('role.index', __('acl::permission.role.index'));
        Permission::add('role.create', __('acl::permission.role.create'));
        Permission::add('role.edit', __('acl::permission.role.edit'));
        Permission::add('role.destroy', __('acl::permission.role.destroy'));
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('admincan', function ($expression) {
            return "<?php if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission({$expression})): ?>";
        });

        Blade::directive('endadmincan', function () {
            return "<?php endif; ?>";
        });
    }

    public function registerAdminMenu()
    {
        Event::listen(CoreAdminMenuRegistered::class, function($menu) {

            $menu->add('User Manager', [
                    'parent' => $menu->system->id
                ])->nickname('user_manager')->data('order', 1)->prepend('<i class="fas fa-user-md"></i>');

            $menu->add('Admin', [
                    'route' => 'admin.profile.index',
                    'parent' => $menu->user_manager->id
                ])->data('order', 1)->prepend('<i class="fas fa-user-md"></i>');
            
                $menu->add('Role', [
                    'route' => 'admin.role.index',
                    'parent' => $menu->user_manager->id
                ])->data('order', 2)->prepend('<i class="fab fa-critical-role"></i>');

            event(AclAdminMenuRegistered::class, $menu);
        });
    }
}
