<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['about','courses','events','gallery','blog','contact']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        return view('App/home');
    }
    public function about()
    {
        return view('App/about');
    }
    public function courses()
    {
        return view('App/courses');
    }
    public function events()
    {
        return view('App/events');
    }
    public function gallery()
    {
        return view('App/gallery');
    }
    public function blog()
    {
        return view('App/blog');
    }
    public function contact()
    {
        return view('App/contact');
    }
}
