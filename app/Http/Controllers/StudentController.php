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
                        <a href="#" class="btn btn-info rounded-0" id="view_student" data-student_id="'.$student -> id.'">View</a>
                        <a href="#" class="btn btn-warning rounded-0" id="edit_student" data-student_id="'.$student -> id.'">Edit</a>
                        <a href="#" class="btn btn-danger rounded-0" id="delete_student" data-student_id="'.$student -> id.'">Delete</a>
                    </div>
                </td>
              </tr>';
        }
    }

    /**
     * view single student
     */
    public function view($id){
        $data = Student::find($id);

        echo '<button class="close" data-dismiss="modal">&times;</button>
                <img src="'.asset('media/student/'.$data -> photo).'" alt="" class="rounded-circle mx-auto d-block shadow mb-3" style="width: 150px;height: 150px;border: 5px solid #fff;">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> '.$data -> name.'</li>
                    <li class="list-group-item"><strong>Email:</strong> '.$data -> email.'</li>
                    <li class="list-group-item"><strong>Cell:</strong> '.$data -> cell.'</li>
                    <li class="list-group-item"><strong>Username:</strong> '.$data -> uname.'</li>
                    <li class="list-group-item"><strong>Age:</strong> '.$data -> age.'</li>
                </ul>';
    }

    /**
     * edit student
     */
    public function edit($id){
        $data = Student::find($id);

        echo json_encode($data);
    }

    /**
     * update student data
     */
    public function update(Request $request, $id){
        $data = Student::find($id);

        if($request -> hasFile('new_photo')){
            $file = $request -> file('new_photo');
            $unique_name = md5(time().rand()).'.'.$file -> getClientOriginalExtension();
            $file -> move(public_path('media/student'), $unique_name);

            if(file_exists('media/student/'.$request -> old_photo)){
                unlink('media/student/'.$request -> old_photo);
            }
        }else{
            $unique_name = $request -> old_photo;
        }

        $data -> name = $request -> name;
        $data -> email = $request -> email;
        $data -> cell = $request -> cell;
        $data -> uname = $request -> uname;
        $data -> age = $request -> age;
        $data -> photo = $unique_name;
        $data -> update();
    }

    /**
     * destroy student
     */
    public function destroy($id){
        $data = Student::find($id);
        $data -> delete();

        if(file_exists('media/student/'.$data -> photo)){
            unlink('media/student/'.$data -> photo);
        }
    }
}
