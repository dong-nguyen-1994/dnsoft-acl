<?php

use Dnsoft\Acl\Http\Controllers\Admin\RoleController;
use Dnsoft\Acl\Http\Controllers\Admin\ProfileController;

Route::prefix('admin')->middleware(['web', 'admin.auth'])->group(function () {

    Route::prefix('role')->group(function () {

        Route::get('', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::put('{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('{id}/destroy', [RoleController::class, 'destroy'])->name('admin.role.destroy');

    });

    Route::prefix('admin')->group(function () {

        Route::get('', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::get('create', [ProfileController::class, 'create'])->name('admin.profile.create');
        Route::post('store', [ProfileController::class, 'store'])->name('admin.profile.store');
        Route::get('{id}/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('{id}', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('{id}/destroy', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

    });
});
