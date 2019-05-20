<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Carga de la página de inicio.<
     */
    public function index()
    {
        return view('public.pages.index');
    }

    public function contact()
    {
      return view('public.pages.contact');
    }

    public function about()
    {
      return view('public.pages.about');
    }

    public function profile()
    {
      return view('public.pages.profile.profile');
    }
    public function miPerfil($tab)
    {
    
      return view('public.pages.profile.'.$tab);
    }
}
