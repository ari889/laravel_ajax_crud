<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * tacher index file load
     */
    public function index(){
        return view('teacher.index');
    }

    /**
     * store teacher
     */
    public function store(Request $request){
        if($request -> hasFile('photo')){
            $file = $request -> file('photo');
            $unique_name = md5(time().rand()).'.'.$file -> getClientOriginalExtension();
            $file -> move(public_path('media/teacher'), $unique_name);
        }

        Teacher::create([
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
        $data = Teacher::latest() -> get();

        $i = 1;
        foreach($data as $teacher){
            echo '<tr>
                <th scope="row">'.$i.'</th>
                <td>'.$teacher -> name.'</td>
                <td>'.$teacher -> email.'</td>
                <td>'.$teacher -> cell.'</td>
                <td>'.$teacher -> uname.'</td>
                <td><img src="'.asset('/media/teacher/'.$teacher -> photo).'" alt="" style="width: 50px;height: 50px;"></td>
                <td>'.$teacher -> age.'</td>
                <td>'.$teacher -> created_at -> diffForHumans().'</td>
                <td class="text-right">
                    <div class="btn-group">
                        <a href="#" class="btn btn-info rounded-0" id="view_teacher" data-teacher_id="'.$teacher -> id.'">View</a>
                        <a href="#" class="btn btn-warning rounded-0" id="edit_teacher" data-teacher_id="'.$teacher -> id.'">Edit</a>
                        <a href="#" class="btn btn-danger rounded-0" id="delete_teacher" data-teacher_id="'.$teacher -> id.'">Delete</a>
                    </div>
                </td>
              </tr>';
            $i++;
        }
    }

    /**
     * view single teacher
     */
    public function view($id){
        $data = Teacher::find($id);

        echo '<button class="close" data-dismiss="modal">&times;</button>
                <img src="'.asset('media/teacher/'.$data -> photo).'" alt="" class="rounded-circle mx-auto d-block shadow mb-3" style="width: 150px;height: 150px;border: 5px solid #fff;">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> '.$data -> name.'</li>
                    <li class="list-group-item"><strong>Email:</strong> '.$data -> email.'</li>
                    <li class="list-group-item"><strong>Cell:</strong> '.$data -> cell.'</li>
                    <li class="list-group-item"><strong>Username:</strong> '.$data -> uname.'</li>
                    <li class="list-group-item"><strong>Age:</strong> '.$data -> age.'</li>
                </ul>';
    }

    /**
     * edit teacher
     */
    public function edit($id){
        $data = Teacher::find($id);

        echo json_encode($data);
    }

    /**
     * update teacher data
     */
    public function update(Request $request, $id){
        $data = Teacher::find($id);

        if($request -> hasFile('new_photo')){
            $file = $request -> file('new_photo');
            $unique_name = md5(time().rand()).'.'.$file -> getClientOriginalExtension();
            $file -> move(public_path('media/teacher'), $unique_name);

            if(file_exists('media/teacher/'.$request -> old_photo)){
                unlink('media/teacher/'.$request -> old_photo);
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
     * destroy teacher
     */
    public function destroy($id){
        $data = Teacher::find($id);
        $data -> delete();

        if(file_exists('media/teacher/'.$data -> photo)){
            unlink('media/teacher/'.$data -> photo);
        }
    }
}
