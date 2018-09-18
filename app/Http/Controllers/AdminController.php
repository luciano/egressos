<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function createUser() 
    {
        return view('admin.create_user');
    }

    public function menuUsers()
    {
        return 'Users';
    }

    public function menuGraph()
    {
        return view('admin.graph');
    }

    public function menuEvents()
    {
        return 'Events';
    }

    public function menuNews()
    {
        return 'News';
    }

    public function menuOpportunities()
    {
        return 'Opportunities';
    }

}


