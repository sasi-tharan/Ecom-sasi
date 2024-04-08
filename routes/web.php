<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubGroupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SeasonBannerController;
use App\Http\Controllers\Admin\FeaturedBannerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Route
Route::prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('admin.roles.index');
        Route::get('/roles/create', 'create')->name('admin.roles.create');
        Route::post('/roles', 'store')->name('admin.roles.store');
        Route::get('/roles/{role_id}/edit', 'edit')->name('admin.roles.edit');
        Route::put('/roles/{role_id}', 'update')->name('admin.roles.update');
        Route::delete('roles/{role_id}', 'destroy')->name('admin.roles.destroy');

    });


    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{user_id}/edit', 'edit');
        Route::put('/users/{user_id}', 'update');
        Route::get('/users/{user_id}/delete', 'destroy');
    });

    //Admin Department Route
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('departments', 'index');
        Route::get('/departments/create', 'create');
        Route::post('/departments/create', 'store');
        Route::get('/departments/{department}/edit', 'edit');
        Route::put('/departments/{department}', 'update');
        Route::get('/departments/{department}/delete', 'destroy');
    });

    // Admin Group Route
    Route::controller(GroupController::class)->group(function () {
        Route::get('groups', 'index');
        Route::get('/groups/create', 'create')->name('admin.groups.create');
        Route::post('/groups/create', 'store')->name('admin.groups.store');
        Route::get('/groups/{group}/edit', 'edit')->name('admin.groups.edit');
        Route::put('/groups/{group}', 'update')->name('admin.groups.update');
        Route::get('/groups/{group}/delete', 'destroy');
    });

    // Admin Group Route
    Route::controller(SubGroupController::class)->group(function () {
        Route::get('subgroups', 'index');
        Route::get('/subgroups/create', 'create')->name('admin.subgroups.create');
        Route::post('/subgroups/create', 'store')->name('admin.subgroups.store');
        Route::get('/subgroups/{subgroup}/edit', 'edit')->name('admin.subgroups.edit');
        Route::put('/subgroups/{subgroup}', 'update')->name('admin.subgroups.update');
        Route::get('/subgroups/{subgroup}/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('sliders', 'index')->name('admin.sliders.index');
        Route::get('/sliders/create', 'create')->name('admin.sliders.create');
        Route::post('/sliders/create', 'store')->name('admin.sliders.store');
        Route::get('/sliders/{slider}/edit', 'edit')->name('admin.sliders.edit');
        Route::put('/sliders/{slider}', 'update')->name('admin.sliders.update');
        Route::get('/sliders/{slider}/delete', 'destroy')->name('admin.sliders.destroy');
    });

    Route::controller(BannerController::class)->group(function () {
        Route::get('banners', 'index')->name('admin.banners.index');
        Route::get('/banners/create', 'create')->name('admin.banners.create');
        Route::post('/banners/create', 'store')->name('admin.banners.store');
        Route::get('/banners/{banner}/edit', 'edit')->name('admin.banners.edit');
        Route::put('/banners/{banner}', 'update')->name('admin.banners.update');
        Route::get('/banners/{banner}/delete', 'destroy')->name('admin.banners.destroy');
    });

    Route::controller(SeasonBannerController::class)->group(function () {
        Route::get('seasonal_banners', 'index')->name('admin.seasonal_banners.index');
        Route::get('/seasonal_banners/create', 'create')->name('admin.seasonal_banners.create');
        Route::post('/seasonal_banners/create', 'store')->name('admin.seasonal_banners.store');
        Route::get('/seasonal_banners/{seasonal_banner}/edit', 'edit')->name('admin.seasonal_banners.edit');
        Route::put('/seasonal_banners/{seasonal_banner}', 'update')->name('admin.seasonal_banners.update');
        Route::get('/seasonal_banners/{seasonal_banner}/delete', 'destroy')->name('admin.seasonal_banners.destroy');
    });

    Route::controller(FeaturedBannerController::class)->group(function () {
        Route::get('featured_banners', 'index')->name('admin.featured_banners.index');
        Route::get('/featured_banners/create', 'create')->name('admin.featured_banners.create');
        Route::post('/featured_banners/create', 'store')->name('admin.featured_banners.store');
        Route::get('/featured_banners/{featured_banner}/edit', 'edit')->name('admin.featured_banners.edit');
        Route::put('/featured_banners/{featured_banner}', 'update')->name('admin.featured_banners.update');
        Route::get('/featured_banners/{featured_banner}/delete', 'destroy')->name('admin.featured_banners.destroy');
    });

    // Admin Group Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('admin.products.index'); // Define the index route
        Route::get('/products/create', 'create')->name('admin.products.create');
        Route::post('/products/create', 'store')->name('admin.products.store');
        // Route::get('/products/{product}', 'show')->name('admin.products.show'); // View product route
        Route::get('/products/{product}/edit', 'edit')->name('admin.products.edit');
        Route::put('/products/{product}', 'update')->name('admin.products.update'); // Add this line for update route
        Route::post('/products/import', 'import')->name('admin.products.import');
        Route::delete('/products/{product}', 'delete')->name('admin.products.delete');
        // Route::get('/products/filter', 'filter')->name('admin.products.filter');
    });

    Route::post('/admin/products/import', [ProductController::class, 'import'])->name('admin.products.import');
    Route::get('/export-products', [ProductController::class, 'export'])->name('export.products');
    Route::get('/admin/products/filter', [ProductController::class, 'filter'])->name('admin.products.filter');


      // Admin Group Route
      Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('admin.orders.index'); // Define the index route
    });

    Route::controller(PermissionController::class)->group(function () {
        Route::get('errors', 'index')->name('admin.errors.index');
    });




});
