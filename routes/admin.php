<?php

use Dnsoft\Acl\Http\Controllers\Admin\RoleController;
use Dnsoft\Acl\Http\Controllers\Admin\ProfileController;

Route::prefix('admin')->middleware(['web', 'admin.auth'])->group(function () {

    Route::prefix('role')->group(function () {

        Route::get('', [RoleController::class, 'index'])
            ->middleware('admin.can:role.index')
            ->name('admin.role.index');

        Route::get('create', [RoleController::class, 'create'])
            ->middleware('admin.can:role.create')
            ->name('admin.role.create');

        Route::post('store', [RoleController::class, 'store'])
            ->middleware('admin.can:role.create')
            ->name('admin.role.store');

        Route::get('{id}/edit', [RoleController::class, 'edit'])
            ->middleware('admin.can:role.edit')
            ->name('admin.role.edit');

        Route::put('{id}', [RoleController::class, 'update'])
            ->middleware('admin.can:role.edit')
            ->name('admin.role.update');

        Route::delete('{id}/destroy', [RoleController::class, 'destroy'])
            ->middleware('admin.can:role.index')
            ->name('admin.role.destroy');
    });

    Route::prefix('admin')->group(function () {

        Route::get('', [ProfileController::class, 'index'])
            ->middleware('admin.can:admin.index')
            ->name('admin.profile.index');

        Route::get('create', [ProfileController::class, 'create'])
            ->middleware('admin.can:admin.create')
            ->name('admin.profile.create');

        Route::post('store', [ProfileController::class, 'store'])
            ->middleware('admin.can:admin.create')
            ->name('admin.profile.store');

        Route::get('{id}/edit', [ProfileController::class, 'edit'])
            ->middleware('admin.can:admin.update')
            ->name('admin.profile.edit');

        Route::put('{id}', [ProfileController::class, 'update'])
            ->middleware('admin.can:admin.update')
            ->name('admin.profile.update');

        Route::delete('{id}/destroy', [ProfileController::class, 'destroy'])
            ->middleware('admin.can:admin.destroy')
            ->name('admin.profile.destroy');

    });
});
