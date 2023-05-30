<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.async.dashboard', [
            'myposts' => Posts::query()->where('user_id', auth()->user()->id)->get(),
            'mycategories' => Categories::query()->where('user_id', auth()->user()->id)
                                               ->get()
        ]);
    }

    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
