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


        foreach($data as $student){
            echo '<tr>
                <th scope="row">1</th>
                <td>'.$student -> name.'</td>
                <td>'.$student -> email.'</td>
                <td>'.$student -> cell.'</td>
                <td>'.$student -> uname.'</td>
                <td><img src="'.asset('/media/student/'.$student -> photo).'" alt="" style="width: 50px;height: 50px;"></td>
                <td>'.$student -> age.'</td>
                <td>'.$student -> created_at -> diffForHumans().'</td>
                <td class="text-right">
                    <div class="btn-group">
                        <a href="#" class="btn btn-info rounded-0" id="view_student" data-student_id="'.$student -> id.'" data-toggle="modal" data-target="#student_show_modal">View</a>
                        <a href="#" class="btn btn-warning rounded-0">Edit</a>
                        <a href="#" class="btn btn-danger rounded-0">Delete</a>
                    </div>
                </td>
              </tr>';
        }
    }
}
