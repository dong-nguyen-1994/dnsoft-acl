<?php

namespace DnSoft\Acl;

use DnSoft\Acl\Contracts\PermissionManagerInterface;
use DnSoft\Acl\Events\AclAdminMenuRegistered;
use DnSoft\Acl\Facades\Permission;
use DnSoft\Acl\Http\Middleware\AdminPermission;
use DnSoft\Acl\Http\Middleware\RedirectIfAdminAuth;
use DnSoft\Acl\Models\Admin;
use DnSoft\Acl\Models\Role;
use DnSoft\Acl\Repositories\AdminRepositoryInterface;
use DnSoft\Acl\Repositories\Eloquents\AdminRepository;
use DnSoft\Acl\Repositories\Eloquents\RoleRepository;
use DnSoft\Acl\Repositories\RoleRepositoryInterface;
use DnSoft\Core\Events\CoreAdminMenuRegistered;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use DnSoft\Acl\Http\Middleware\AdminAuth;

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

    $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
    $this->loadRoutesFrom(__DIR__ . '/../routes/auth.php');

    require_once __DIR__ . '/../helpers/helpers.php';

    AliasLoader::getInstance()->alias('Permission', Permission::class);
  }

  public function register()
  {
    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'acl');

    $this->mergeConfigFrom(__DIR__ . '/../config/acl.php', 'acl');
    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'acl');

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
    $aclConfigData = include __DIR__ . '/../config/acl.php';
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

    Permission::add('admin.index', __('acl::permission.admin.index'));
    Permission::add('admin.create', __('acl::permission.admin.create'));
    Permission::add('admin.edit', __('acl::permission.admin.edit'));
    Permission::add('admin.destroy', __('acl::permission.admin.destroy'));
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
    Event::listen(CoreAdminMenuRegistered::class, function ($menu) {

      // $menu->add('User Manager', [
      //   'parent' => $menu->system->id
      // ])->nickname('user_manager')->data('order', 1);

      $menu->add('Admin', [
        'route' => 'admin.profile.index',
        'parent' => $menu->system->id
      ])->data('order', 1)->prepend('<i class="fas fa-user-md"></i>');

      $menu->add('Role', [
        'route' => 'admin.role.index',
        'parent' => $menu->system->id
      ])->data('order', 2)->prepend('<i class="fab fa-critical-role"></i>');

      event(AclAdminMenuRegistered::class, $menu);
    });
  }
}
