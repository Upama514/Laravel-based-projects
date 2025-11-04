<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return response()->json(['message' => 'Welcome to Book Club API.']);
    }

    public function about()
    {
        return response()->json(['message' => 'This is a Book Club API powered by Laravel 11.']);
    }
}
