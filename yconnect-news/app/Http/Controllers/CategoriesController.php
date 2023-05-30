<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
  public function index()
  {
    $mycategories = Categories::query()->where('user_id', auth()->user()->id)->paginate(4);

    return view('dashboard.async.categories', ['categories' => $mycategories]);
  }

  public function create(Request $request)
  {
    $validator = Validator::make($request->only(['slug', 'name']), [
      'name' => 'required|string'
    ], [
      'name.required' => 'Category field must be required',
    ]);

    if ( $validator->fails() ) {
      return back()->with('failed', 'Category failed to be post!')
                   ->withErrors($validator)
                   ->withInput();
    }

    Categories::create([
      'user_id' => intval(auth()->user()->id),
      'slug' => Str::slug($request->name),
      'name' => Str::title($request->name)
    ]);

    return redirect('/dashboard/categories')->with('success', 'Category success to be post!');
  }

  public function update(Request $request, $slug) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string'
    ], [
      'name.required' => 'Field category name must be available!'
    ]);

    if( $validator->fails() ) {
      return back()->with('failed', 'Category failed to be updated!')
                   ->withErrors($validator)
                   ->withInput();
    }

    $getCategory = Categories::query()->where('slug', $slug)->get();
  
    foreach($getCategory as $category) {
      $category['slug'] = Str::slug($request->name);
      $category['name'] = $request->name;
      $category->save();
    }

    return redirect('/dashboard/categories')->with('success', 'Category success to be update!');
  }

  public function delete($slug)
  {
    $getCategory = Categories::query()->where('slug', $slug)
                                      ->where('user_id', auth()->user()->id);
                                      
    $getCategory->delete();

    return back()->with('success', 'Category was deleted!');
  }
}
