<?php

use Dnsoft\Acl\Http\Controllers\Admin\RoleController;

Route::prefix('admin')->middleware(['web', 'admin.auth'])->group(function () {

    Route::prefix('role')->group(function () {

        Route::get('', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::put('{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::get('{id}/destroy', [RoleController::class, 'destroy'])->name('admin.role.destroy');

    });
});
