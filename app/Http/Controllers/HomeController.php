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
        $this->middleware('auth');
    }

    /**
     * Show the application __dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function index2()
    {
        return view('home-original');
    }

    public function index_ciudadano()
    {
        return view('home-ciudadano');
    }

    public function index_dependencia()
    {
        return view('home-dependencia');
    }

}
