<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index(Request $request)
  {
    $posts = Posts::latest()->get();

    if ($request['search'] != null) {
        $posts = Posts::query()->where('title', 'like', '%' . $request['search'] . '%')
            ->orWhere('content', 'like', '%' . $request['search'] . '%')
            ->orWhereRelation('category', 'name', 'like', '%' . $request['search'] . '%')->latest()->get();
    }

    return view('home.index', ['posts' => $posts]);
  }

  public function showPostByAuthor($slug)
  {
    $getUserBySlug = User::query()->where('slug', $slug)->get();

    if ($getUserBySlug->isEmpty()) {
      abort(404);
    }

    $posts = Posts::query()->where('user_id', $getUserBySlug[0]->id)->get();

    return view('home.author', ['posts' => $posts]);
  }

  public function showPostByCategory($slug)
  {
    $category = Categories::query()->where('slug', $slug)->get();

    if ($category->isEmpty()) {
      abort(404);
    }

    $posts = Posts::query()->whereRelation('category', 'slug', $category[0]->slug)->get();

    return view('home.category', ['posts' => $posts]);
  }

  public function showDetailPost($slug)
  {
    return view('home.post', ['posts' => Posts::query()->where('slug', $slug)->get()]);
  }
}
