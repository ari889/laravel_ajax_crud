<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * index page load
     */
    public function index(){
        return view('student.index');
    }

    /**
     * store student
     */
    public function store(Request $request){
        if($request -> hasFile('photo')){
            $file = $request -> file('photo');
            $unique_name = md5(time().rand()).'.'.$file -> getClientOriginalExtension();
            $file -> move(public_path('media/student'), $unique_name);
        }

        Student::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'cell' => $request -> cell,
            'uname' => $request -> uname,
            'password' => password_hash($request -> password, PASSWORD_DEFAULT),
            'age' => $request -> age,
            'photo' => $unique_name
        ]);
    }

    /**
     * show all data
     */
    public function show(){
        $data = Student::latest() -> get();
    }
}
