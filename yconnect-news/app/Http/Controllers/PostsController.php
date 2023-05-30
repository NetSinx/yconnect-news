<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::query()->where('user_id', auth()->user()->id)->paginate(4);

        return view('dashboard.async.posts', ['posts' => $posts]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5|unique:posts',
            'image' => ['required', File::image()->max(512)],
            'category' => 'required|int',
            'content' => 'required|min:10'
        ], [
            'title.required' => 'Judul postingan wajib diisi!',
            'title.unique' => 'Judul postingan sudah ada!',
            'title.min' => 'Judul postingan minimal 5 karakter!',
            'category.integer' => 'Kategori postingan wajib dipilih!',
            'content.required' => 'Konten postingan wajib diisi!',
            'content.min' => 'Konten postingan minimal 10 karakter!'
        ]);

        if ( $validator->fails() ) {
            return back()->with('failed', 'Postingal gagal dibuat!')->withErrors($validator)->withInput();
        }

        Posts::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'image' => $request->file('image')->store('image-posts'),
            'slug' => Str::slug($request->title),
            'excerpt' => Str::limit($request->content),
            'category_id' => intval($request->category),
            'content' => $request->content
        ]);

        return redirect('/dashboard/posts')->with('success', 'Postingan berhasil dibuat!');
    }

    public function update(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'category' => 'required|int',
            'image' => ['required', File::image()->max(512)],
            'content' => 'required|string|min:10'
        ], [
            'title.required' => 'Judul postingan wajib diisi!',
            'title.min' => 'Judul postingan minimal 5 karakter!',
            'category.integer' => 'Kategori postingan wajib dipilih!',
            'content.required' => 'Konten postingan wajib diisi!',
            'content.min' => 'Konten postingan minimal 10 karakter!'
        ]);

        if ( $validator->fails() ) {
            return back()->with('failed', 'Post failed to be update!')->withErrors($validator)->withInput();
        }

        $getPost = Posts::query()->where('slug', $slug)->get();

        foreach( $getPost as $post ) {    
            Storage::delete($post->image);
            
            $post['user_id'] = auth()->user()->id;
            $post['title'] = $request->title;
            $post['image'] = $request->file('image')->store('image-posts');
            $post['slug'] = Str::slug($request->title);
            $post['excerpt'] = Str::limit($request->content);
            $post['category_id'] = intval($request->category);
            $post['content'] = $request->content;
            $post->save();
        }

        return redirect('/dashboard/posts')->with('success', 'Postingan berhasil diubah!');
    }

    public function delete($slug)
    {
        $getPost = Posts::query()->where('slug', $slug)->get();

        Storage::delete($getPost[0]->image);

        Posts::query()->where('slug', $slug)->delete();
        
        return back()->with('success', 'Postingan berhasil dihapus!');
    }

}
