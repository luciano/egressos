<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;

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

    public function users()
    {
        return view('admin.users');
    }

    public function listUser() 
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.list-user')->with('users', $users);
    }

    public function listAdmin() 
    {
        $admins = Admin::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.list-admin')->with('admins', $admins);
    }

    public function removeAdmin($id)
    {
        if (!is_numeric($id))
            return redirect(route('admin.admins.list'));

        $admin = Admin::find($id);
        $admin->delete();
        return redirect(route('admin.admins.list'))->with('success', 'Administrador removido com Sucesso');
    }

    public function removeUser($id)
    {
        if (!is_numeric($id))
            return redirect(route('admin.users.list'));

        $user = User::find($id);
        $user->delete();
        return redirect(route('admin.users.list'))->with('success', 'Usuário removido com Sucesso');
    }

    public function detailsUser($id) 
    {
        $user = User::find($id);
        return 'details for '.$user->name.' - id= '.$user->id;
    }

    public function graph()
    {
        return view('admin.graph');
    }
}


