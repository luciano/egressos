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

// Paginator to use $users->links()
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function listUser(Request $request)
    {
        if ($request->ajax()) 
        {
            if ($request['course'] == "all" && $request['typ'] == "all" && $request['year'] == "all")
            {
                $users = User::orderBy('name', 'asc')->paginate(15);
                return view('admin.list-user')->with('users', $users)->renderSections()['info-user'];
            }
            else if ($request['course'] == "all" && $request['typ'] == "all" && $request['year'] != "all")
            {
                // ano especifico                
                $student_courses = StudentCourse::whereYear('conclusion_date', $request['year'])->get();
                $users = array();

                foreach ($student_courses as $student_course)
                {
                    array_push($users, $student_course->student->user);
                }
            }
            else if ($request['course'] == "all" && $request['typ'] != "all" && $request['year'] != "all")
            {
                // ano e tipo especifico
                $courses = Course::where('typ', $request['typ'])->get();                
                $users = array();

                foreach ($courses as $course)
                {
                    $student_courses = StudentCourse::whereYear('conclusion_date', $request['year'])->where('course_id', $course->id)->get();
                    foreach ($student_courses as $student_course)
                    {
                        array_push($users, $student_course->student->user);
                    }
                }
            }
            else if ($request['course'] != "all" && $request['typ'] == "all" && $request['year'] != "all")
            {
                // ano e curso especifico
                $student_courses = StudentCourse::whereYear('conclusion_date', $request['year'])->where('course_id', $request['course'])->get();
                $users = array();

                foreach ($student_courses as $student_course)
                {
                    array_push($users, $student_course->student->user);
                }
            }
            else if ($request['course'] == "all" && $request['typ'] != "all" && $request['year'] == "all")
            {
                // tipo especifico
                $courses = Course::where('typ', $request['typ'])->get();                
                $users = array();

                foreach ($courses as $course)
                {
                    $student_courses = StudentCourse::where('course_id', $course->id)->get();
                    foreach ($student_courses as $student_course)
                    {
                        array_push($users, $student_course->student->user);
                    }
                }
            }
            else if ($request['course'] != "all" && $request['typ'] != "all" && $request['year'] == "all")
            {
                // tipo e curso especifico
                $courses = Course::where('typ', $request['typ'])->where('id', $request['course'])->get();                
                $users = array();

                foreach ($courses as $course)
                {
                    $student_courses = StudentCourse::where('course_id', $course->id)->get();
                    foreach ($student_courses as $student_course)
                    {
                        array_push($users, $student_course->student->user);
                    }
                }
            }
            else if ($request['course'] != "all" && $request['typ'] == "all" && $request['year'] == "all")
            {
                // curso especifico
                $student_courses = StudentCourse::where('course_id', $request['course'])->get();
                $users = array();
                
                foreach ($student_courses as $student_course)
                {
                    array_push($users, $student_course->student->user);
                }
            }
            else if ($request['course'] != "all" && $request['typ'] != "all" && $request['year'] != "all")
            {
                // todos especifico
                $courses = Course::where('typ', $request['typ'])->where('id', $request['course'])->get();                
                $users = array();

                foreach ($courses as $course)
                {
                    $student_courses = StudentCourse::whereYear('conclusion_date', $request['year'])->where('course_id', $course->id)->get();
                    foreach ($student_courses as $student_course)
                    {
                        array_push($users, $student_course->student->user);
                    }
                }
            }

            // create paginator from array
            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            // Create a new Laravel collection from the array data
            $itemCollection = collect($users);
    
            // Define how many items we want to be visible in each page
            $perPage = 15;
    
            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
    
            // Create our paginator and pass it to the view
            $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
    
            // set url path for generted links
            $paginatedItems->setPath($request->url());

            return view('admin.list-user')->with('users', $paginatedItems)->renderSections()['info-user'];
        }

        $courses = Course::orderBy('name', 'asc')->get();
        return view('admin.list-user')->with('courses', $courses);
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


