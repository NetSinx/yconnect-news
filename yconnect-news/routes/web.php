<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function() {
  Route::get('/sign-in', [LoginController::class, 'index'])
  ->name('login');

  Route::post('/sign-in', [LoginController::class, 'login']);

  Route::get('/sign-up', [RegisterController::class, 'index']);

  Route::post('/sign-up', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function() {
  Route::get('/dashboard', function() {
    $myPosts = Posts::query()->where('user_id', auth()->user()->id)->get();
    $myCategories = Categories::query()->where('user_id', auth()->user()->id)->get();

    return view('dashboard.index', [
      'myposts' => $myPosts,
      'mycategories' => $myCategories
    ]);
  });

  Route::get('/dashboard/klndfoighdfg3th34thifgjdfkjgdnjb32irk', [DashboardController::class, 'index']);

  Route::get('/dashboard/posts', function() {
    $posts = Posts::query()->where('user_id', auth()->user()->id)->paginate(4);

    return view('dashboard.posts.index', ['posts' => $posts]);
  });

  Route::get('/dashboard/hjkdsfhkj4353459874hfjk', [PostsController::class, 'index']);

  Route::get('/dashboard/posts/create', function () {
    return view('dashboard.posts.create', ['categories' => Categories::query()->where('user_id', auth()->user()->id)->get()]);
  });

  Route::post('/dashboard/posts/create', [PostsController::class, 'create']);

  Route::delete('/dashboard/posts/delete/{slug}', [PostsController::class, 'delete']);

  Route::get('/dashboard/posts/edit/{slug}', function ($slug) {
    $getPost = Posts::query()->where('slug', $slug)
                             ->where('user_id', auth()->user()->id)->get();

    return view('dashboard.posts.edit', ['posts' => $getPost]);
  });

  Route::put('/dashboard/posts/edit/{slug}', [PostsController::class, 'update']);

  Route::get('/dashboard/categories', function() {
    $mycategories = Categories::query()->where('user_id', auth()->user()->id)->paginate(4);

    return view('dashboard.categories.index', ['categories' => $mycategories]);
  });

  Route::get('/dashboard/lkjgdfyhgiu43893489gjdfgdfgfkgf', [CategoriesController::class, 'index']);
  
  Route::get('/dashboard/categories/create', function() {
    return view('dashboard.categories.create');
  });

  Route::post('/dashboard/categories/create', [CategoriesController::class, 'create']);

  Route::get('/dashboard/categories/edit/{slug}', function($slug) {
    $categories = Categories::query()->where('slug', $slug)
                                        ->where('user_id', auth()->user()->id)
                                        ->get();

    return view('dashboard.categories.edit', ['categories' => $categories]);
  });

  Route::put('/dashboard/categories/edit/{slug}', [CategoriesController::class, 'update']);

  Route::delete('/dashboard/categories/delete/{slug}', [CategoriesController::class, 'delete']);

  Route::post('/dashboard/sign-out', [DashboardController::class, 'signout']);
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/post/creator/{slug}', [HomeController::class, 'showPostByAuthor']);

Route::get('/post/category/{slug}', [HomeController::class, 'showPostByCategory']);

Route::get('/post/{slug}', [HomeController::class, 'showDetailPost']);