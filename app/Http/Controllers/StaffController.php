<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * staff index view load
     */
    public function index(){
        return view('staff.index');
    }

    /**
     * store staff
     */
    public function store(Request $request){
        if($request -> hasFile('photo')){
            $file = $request -> file('photo');
            $unique_name = md5(time().rand()).'.'.$file -> getClientOriginalExtension();
            $file -> move(public_path('media/staff'), $unique_name);
        }

        Staff::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'cell' => $request -> cell,
            'uname' => $request -> uname,
            'password' => password_hash($request -> uname, PASSWORD_DEFAULT),
            'age' => $request -> age,
            'photo' => $unique_name,
        ]);
    }

    /**
     * show all staff
     */
    public function show(){
        $data = Staff::latest() -> get();

        $i = 1;
        foreach($data as $staff){
            echo '<tr>
                <th scope="row">'.$i.'</th>
                <td>'.$staff -> name.'</td>
                <td>'.$staff -> email.'</td>
                <td>'.$staff -> cell.'</td>
                <td>'.$staff -> uname.'</td>
                <td><img src="'.asset('/media/staff/'.$staff -> photo).'" alt="" style="width: 50px;height: 50px;"></td>
                <td>'.$staff -> age.'</td>
                <td>'.$staff -> created_at -> diffForHumans().'</td>
                <td class="text-right">
                    <div class="btn-group">
                        <a href="#" class="btn btn-info rounded-0" id="view_staff" data-staff_id="'.$staff -> id.'">View</a>
                        <a href="#" class="btn btn-warning rounded-0" id="edit_staff" data-staff_id="'.$staff -> id.'">Edit</a>
                        <a href="#" class="btn btn-danger rounded-0" id="delete_staff" data-staff_id="'.$staff -> id.'">Delete</a>
                    </div>
                </td>
              </tr>';
            $i++;
        }
    }

    /**
     * view single staff
     */
    public function view($id){
        $data = Staff::find($id);

        echo '<button class="close" data-dismiss="modal">&times;</button>
                <img src="'.asset('media/staff/'.$data -> photo).'" alt="" class="rounded-circle mx-auto d-block shadow mb-3" style="width: 150px;height: 150px;border: 5px solid #fff;">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> '.$data -> name.'</li>
                    <li class="list-group-item"><strong>Email:</strong> '.$data -> email.'</li>
                    <li class="list-group-item"><strong>Cell:</strong> '.$data -> cell.'</li>
                    <li class="list-group-item"><strong>Username:</strong> '.$data -> uname.'</li>
                    <li class="list-group-item"><strong>Age:</strong> '.$data -> age.'</li>
                </ul>';
    }

    /**
     * edit staff
     */
    public function edit($id){
        $data = Staff::find($id);

        echo json_encode($data);
    }

    /**
     * update student data
     */
    public function update(Request $request, $id){
        $data = Staff::find($id);

        if($request -> hasFile('new_photo')){
            $file = $request -> file('new_photo');
            $unique_name = md5(time().rand()).'.'.$file -> getClientOriginalExtension();
            $file -> move(public_path('media/staff'), $unique_name);

            if(file_exists('media/staff/'.$request -> old_photo)){
                unlink('media/staff/'.$request -> old_photo);
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
        $data = Staff::find($id);
        $data -> delete();

        if(file_exists('media/staff/'.$data -> photo)){
            unlink('media/staff/'.$data -> photo);
        }
    }
}
