<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $categories = '';
        if(Auth::user()->isAdmin()) {
            $news = News::all();
            $categories = Category::all();
        } else {
            $news = News::where('user_id', Auth::user()->id)->where('is_published', 1)->get();
        }
        return view('dashboard', compact('news', 'categories'));
    }


}
