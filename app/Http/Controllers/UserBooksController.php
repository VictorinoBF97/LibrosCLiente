<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserBooksController extends Controller
{
    public function index($userSlug)
    {
        $user = User::where('slug', $userSlug)->firstOrFail();
        $books = $user->books()->paginate(10);

        return view('public.userbooks.index',[
            'user'  => $user,
            'books' => $books
        ]);
    }
}
