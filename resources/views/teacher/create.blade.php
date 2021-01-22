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
        <div class="btn-group">
            <a href="{{route('teacher.index')}}" class="btn btn-primary rounded-0">All teachers</a>
            <a href="{{route('crud.index')}}" class="btn btn-dark rounded-0">Home</a>
        </div>
		<h2 class="mt-2">Create new teacher.</h2>
		<div class="message">
            @include('validate')
		</div>
		<form method="POST" action="{{route('teacher.store')}}" enctype="multipart/form-data">
            @csrf
		  <div class="form-group">
		    <label for="exampleInputName1">Name</label>
		    <input name="name" value="{{old('name')}}" type="text" class="form-control" id="exampleInputName1" aria-describedby="emailHelp">
              @if($errors -> has('name'))
                  <p class="text-danger">{{$errors -> first('name')}}</p>
                  @endif
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email</label>
		    <input name="email" value="{{old('email')}}" type="text" class="form-control" id="exampleInputEmail1">
              @if($errors -> has('email'))
                  <p class="text-danger">{{$errors -> first('email')}}</p>
              @endif
		  </div>
		   <div class="form-group">
		    <label for="cell">Cell</label>
		    <input name="cell" value="{{old('cell')}}" type="text" class="form-control" id="cell">
               @if($errors -> has('cell'))
                   <p class="text-danger">{{$errors -> first('cell')}}</p>
               @endif
		  </div>
          <div class="form-group">
           <label for="username">Username</label>
           <input name="uname" value="{{old('uname')}}" type="text" class="form-control" id="username">
              @if($errors -> has('uname'))
                  <p class="text-danger">{{$errors -> first('uname')}}</p>
              @endif
         </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input name="age" value="{{old('age')}}" type="text" class="form-control" id="age">
                @if($errors -> has('age'))
                    <p class="text-danger">{{$errors -> first('age')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" value="{{old('password')}}" type="password" class="form-control" id="password">
                @if($errors -> has('password'))
                    <p class="text-danger">{{$errors -> first('password')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input name="photo" value="" type="file" class="form-control" id="photo">
            </div>
            <input class="btn btn-primary rounded-0" value="Create Now" type="submit">
		</form>
	</div>
	<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
