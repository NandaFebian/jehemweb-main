<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about', [
            'reviews' => Comment::query()->with('user')->where('is_active', true)->latest()->limit(6)->get(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}
