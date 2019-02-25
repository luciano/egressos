<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Student;
use App\Address;
use App\Phone;
use App\StudentCourse;
use App\Course;

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

        if ($user->student == null)
            return view('admin.details-user', ['user' => $user]);

        return view('admin.details-user', [
            'user' => $user,
            'student' => $user->student,
            'address' => $user->student->address,
            'phones' => $user->student->phone,
            'student_courses' => $user->student->student_course,
        ]);
    }

    public function graph()
    {
        return view('admin.graph');
    }
}


