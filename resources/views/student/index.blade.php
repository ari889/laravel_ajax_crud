<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel Ajax crud</title>
	<link rel="stylesheet" href="{{asset('style.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/all.min.css')}}">
</head>
<body>
	<div class="container mt-5">
        <div class="btn-group">
            <a href="#" class="btn btn-success rounded-0" data-toggle="modal" data-target="#student_add_modal">Add new student</a>
            <a href="{{route('ajax.index')}}" class="btn btn-dark rounded-0">Home</a>
        </div>
    <div class="card rounded-0 shadow">
      <div class="card-header">
        <h3>All students</h3>
      </div>
      <div class="card-body p-0">
          <div class="message">
          </div>
        <table class="table table-hover table-dark mb-0 text-center">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Cell</th>
              <th scope="col">Username</th>
              <th scope="col">Photo</th>
              <th scope="col">Age</th>
              <th scope="col">Created at</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="show_student">

          </tbody>
        </table>
      </div>
    </div>
	</div>

{{--    add student modal --}}
    <div class="modal fade" id="student_add_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <p class="mb-0 text-white font-weight-bold">Add student</p>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="student_add_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="student_add_message"></div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Your name:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Valid email:</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cell">Cell:</label>
                                    <input type="text" class="form-control" id="cell" name="cell">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="uname">Username:</label>
                                    <input type="text" class="form-control" id="uname" name="uname">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="age">Age:</label>
                                    <input type="text" class="form-control" id="age" name="age">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="#" alt="" class="img-fluid" id="student_add_image">
                            <label for="photo" class="text-secondary border rounded-sm p-2"><i class="fas fa-image"></i> Upload photo</label>
                            <input type="file" class="d-none" id="photo" name="photo">
                        </div>
                </div>
                <div class="modal-footer bg-success">
                    <input type="submit" name="submit" value="Add" class="btn btn-light btn-sm rounded-0">
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--student view modal--}}
    <div class="modal fade" id="student_show_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" id="single_student_data">

                </div>
            </div>
        </div>
    </div>

{{--    student edit modal--}}
    <div class="modal fade" id="student_edit_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="edit_single_student">
                <div class="modal-header bg-success">
                    <p class="mb-0 text-white font-weight-bold">Edit student</p>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="student_edit_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="student_edit_message"></div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Your name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Valid email:</label>
                                    <input type="text" class="form-control" id="email" name="email" value="'.$data -> email.'">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cell">Cell:</label>
                                    <input type="text" class="form-control" id="cell" name="cell" value="'.$data -> cell.'">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="uname">Username:</label>
                                    <input type="text" class="form-control" id="uname" name="uname" value="'.$data -> uname.'">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="text" class="form-control" id="age" name="age" value="'.$data -> age.'">
                        </div>
                        <div class="form-group">
                            <img src="" alt="" class="img-fluid" id="photo-show">
                            <label for="new_photo" class="text-secondary border rounded-sm p-2"><i class="fas fa-image"></i> Upload photo</label>
                            <input type="hidden" id="old_photo" name="old_photo">
                            <input type="file" class="d-none" id="new_photo" name="new_photo">
                        </div>
                </div>
                <div class="modal-footer bg-success">
                    <input type="submit" name="submit" value="Update" class="btn btn-light btn-sm rounded-0">
                    </form>
                </div>
            </div>
        </div>
    </div>

	<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/all.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/functions.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
</body>
</html>
