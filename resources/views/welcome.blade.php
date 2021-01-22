<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Form Validation</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>

<div class="container p-center">
    <div class="card-group shadow">
        <div class="card rounded-0">
            <div class="card-body p-0">
                <img src="{{asset('images/teacher.png')}}" alt="" class="img-fluid">
                <div class="btn-group w-100">
                    <a href="{{route('teacher.index')}}" class="btn btn-success rounded-0">All teachers</a>
                    <a href="{{route('teacher.create')}}" class="btn btn-success rounded-0">Add teacher</a>
                </div>
            </div>
        </div>
        <div class="card rounded-0">
            <div class="card-body p-0">
                <img src="{{asset('images/staff.png')}}" alt="" class="img-fluid">
                <div class="btn-group w-100">
                    <a href="{{route('staff.index')}}" class="btn btn-info rounded-0">All staff</a>
                    <a href="{{route('staff.create')}}" class="btn btn-info rounded-0">Add staff</a>
                </div>
            </div>
        </div>
        <div class="card rounded-0">
            <div class="card-body p-0">
                <img src="{{asset('images/student.png')}}" alt="" class="img-fluid">
                <div class="btn-group w-100">
                    <a href="{{route('student.index')}}" class="btn btn-danger rounded-0">All students</a>
                    <a href="{{route('student.create')}}" class="btn btn-danger rounded-0">Add student</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
