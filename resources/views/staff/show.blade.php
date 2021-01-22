<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Form Validation</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
	<div class="custom_signup">
		<a href="{{route('staff.index')}}" class="btn btn-primary rounded-0">Back</a>
    <div class="card mt-3">
      <div class="card-body">
        <img src="{{URL::to('/')}}/media/staff/{{$staff -> photo}}" alt="" class="user-image shadow-sm">
        <h3 class="text-center">{{$staff -> name}}</h3>
        <table class="table">
          <tr>
            <td>Email:</td>
            <td>{{$staff -> email}}</td>
          </tr>
          <tr>
            <td>Cell:</td>
            <td>{{$staff -> cell}}</td>
          </tr>
          <tr>
            <td>Age:</td>
            <td>{{$staff -> age}}</td>
          </tr>
          <tr>
            <td>Username:</td>
            <td>{{$staff -> uname}}</td>
          </tr>
        </table>
      </div>
    </div>
	</div>
    <script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
