<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyCRUDController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('client.master');
// });

Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::prefix('categories')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('categories.index');
        // Route::get('/create', [CategoryController::class, 'create']);
        Route::post('', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
    Route::prefix('posts')->group(function () {
        Route::get('', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/create', [PostController::class, 'store'])->name('posts.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/edit/{id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::post('/poststitle', [PostController::class, 'to_slug'])->name('posts.to_slug');
        Route::post('/upload-images', [PostController::class, 'uploadImages'])->name('posts.uploadImages');
    });
});
Route::resource('companies', CompanyCRUDController::class);
Route::post('delete-company', [CompanyCRUDController::class, 'destroy']);

// Route::get('manage-menus/{id?}', [MenuController::class, 'index']);
Route::get('manage-menus/{id?}', [MenuController::class, 'index']);
Route::post('create-menu', [MenuController::class, 'store']);
Route::get('add-categories-to-menu', [menuController::class, 'addCatToMenu']);
Route::get('add-post-to-menu', [MenuController::class, 'addPostToMenu']);
Route::get('add-custom-link', [MenuController::class, 'addCustomLink']);
Route::get('update-menu', [MenuController::class, 'updateMenu']);
Route::post('update-menuitem/{id}', [MenuController::class, 'updateMenuItem']);
Route::get('delete-menuitem/{id}/{key}/{in?}', [MenuController::class, 'deleteMenuItem']);
Route::get('delete-menu/{id}', [MenuController::class, 'destroy']);
Route::get('', [ClientController::class, 'index'])->name('home');
Route::get('/{slug}.html', [ClientController::class, 'single'])
    ->where('slug', '[a-zA-Z0-9-_]+')
    ->name('single.post');
Route::get('/{slug}', [ClientController::class, 'category'])->where('slug', '[a-zA-Z0-9-_]+')->name('category.post');
