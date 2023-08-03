<?php

use App\Http\Controllers\Blog\PostsController as BlogPostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('blog/posts/{post}',[blogPostsController::class, 'show'])->name('blog.show');
Route::get('blog/categories/{category}',[blogPostsController::class, 'category'])->name('blog.category');
Route::get('blog/tags/{tag}',[blogPostsController::class, 'tag'])->name('blog.tag');
Auth::routes();

Route::middleware(['auth'])->group(function(){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', App\Http\Controllers\CategoriesController::class);

Route::resource('tags', App\Http\Controllers\TagsController::class);

Route::resource('posts', PostsController::class);

Route::get('trashed-posts', [PostsController::class, 'trashed'])->name('trashed-posts.index');

Route::put('restore-post/{post}',[PostsController::class, 'restore'])->name('restore-posts');
});

Route::middleware(['auth','admin'])->group(function (){
    Route::get('users/profile',[UsersController::class,'edit'])->name('users.edit-profile');
    Route::put('users/update',[UsersController::class,'update'])->name('users.update-profile');
    Route::get('users',[UsersController::class,'index'])->name('users.index');
    Route::post('users/{user}/make-admin',[UsersController::class,'makeAdmin'])->name('users.make-admin');
});