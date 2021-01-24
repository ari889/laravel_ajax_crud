(function ($) {
    $(document).ready(function(){

        /**
         * show last selected image
         */
        $(document).on('change', '#student_add_form #photo', function(e){
            e.preventDefault();
            let file_url = URL.createObjectURL(e.target.files[0]);
            $('#student_add_form #student_add_image').attr('src', file_url);
        });

        /**
         * add student
         */
        $(document).on('submit', '#student_add_form', function(e){
            e.preventDefault();
            let name = $('#student_add_form input[name="name"]').val();
            let email = $('#student_add_form input[name="email"]').val();
            let cell = $('#student_add_form input[name="cell"]').val();
            let uname = $('#student_add_form input[name="uname"]').val();
            let password = $('#student_add_form input[name="password"]').val();
            let age = $('#student_add_form input[name="age"]').val();
            let photo = $('#student_add_form input[name="photo"]').val();

            if(name === '' || email === '' ||uname === '' || password === ''){
                message('Field must not be empty', '.student_add_message');
            }else if(validateEmail(email) == false){
                message('Invalid email address', '.student_add_message');
            }else if(uname.length < 2){
                message('Username at least 2 character', '.student_add_message', 'warning');
            }else if(password.length < 3){
                message('Password at least 3 character', '.student_add_message');
            }else{
                $.ajax({
                    url     : 'student/store',
                    method  : "POST",
                    data    : new FormData(this),
                    contentType: false,
                    processData: false,
                    success : function(data){
                        $('#student_add_form')[0].reset();
                        $('#student_add_modal').modal('hide');
                        getStudent();
                    }
                });
            }

        });


        /**
         * get all student data
         */
        getStudent();
        function getStudent(){
            $.ajax({
                url: 'student/show',
                success: function(data){
                    $('#show_student').html(data);
                }
            });
        }

        /**
         * view single student data
         */
        $(document).on('click', '#view_student', function(e){
           e.preventDefault();
           let student_id = $(this).data('student_id');
           $.ajax({
                url: 'student/view/'+student_id,
               success: function(data){
                    $('#single_student_data').html(data);
                    $('#student_show_modal').modal('show');
               }
           });
        });

        /**
         * edit student show
         */
        $(document).on('click', '#edit_student', function(e){
            e.preventDefault();
            let student_id = $(this).data('student_id');
            $.ajax({
               url: 'student/'+student_id+'/edit',
                success: function(data){
                    let parseJson = $.parseJSON(data);
                    $('#student_edit_form #name').val(parseJson.name);
                    $('#student_edit_form #email').val(parseJson.email);
                    $('#student_edit_form #cell').val(parseJson.cell);
                    $('#student_edit_form #uname').val(parseJson.uname);
                    $('#student_edit_form #age').val(parseJson.age);
                    $('#student_edit_form #photo-show').attr('src', '../media/student/'+parseJson.photo);
                    $('#student_edit_form #old_photo').val(parseJson.photo);
                    $('#student_edit_form').attr('data-student_id', parseJson.id);
                    $('#student_edit_modal').modal('show');
                }
            });
        });

        /**
         * show last selected image while update
         */
        $(document).on('change', '#student_edit_form #new_photo', function(e){
            e.preventDefault();
            let file_url = URL.createObjectURL(e.target.files[0]);
            $('#student_edit_form #photo-show').attr('src', file_url);
        });

        /**
         * edit student data
         */
        $(document).on('submit', '#student_edit_form', function(e){
            e.preventDefault();

            let student_id = $(this).data('student_id');
            let name = $('#student_edit_form input[name="name"]').val();
            let email = $('#student_edit_form input[name="email"]').val();
            let cell = $('#student_edit_form input[name="cell"]').val();
            let uname = $('#student_edit_form input[name="uname"]').val();
            let password = $('#student_edit_form input[name="password"]').val();
            let age = $('#student_edit_form input[name="age"]').val();
            let photo = $('#student_edit_form input[name="photo"]').val();

            if(name === '' || email === '' ||uname === '' || password === ''){
                message('Field must not be empty', '.student_edit_message');
            }else if(validateEmail(email) == false){
                message('Invalid email address', '.student_edit_message');
            }else if(uname.length < 2){
                message('Username at least 2 character', '.student_edit_message', 'warning');
            }else{
                $.ajax({
                   url: 'student/update/'+student_id,
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(){
                        getStudent();
                        $('#student_edit_modal').modal('hide');
                    }
                });
            }
        });


        /**
         * delete student
         */
        $(document).on('click', '#delete_student', function(e){
            e.preventDefault();
           let student_id = $(this).data('student_id');
           let con = confirm('Are u sure to delete?');
           if(con === true){
               $.ajax({
                   url: 'student/destroy/'+student_id,
                   success: function(){
                       getStudent();
                       message('Student deleted successful', '.message', 'success');
                   }
               });
           }
        });

        /**
         * show last selected image
         */
        $(document).on('change', '#staff_add_form #photo', function(e){
            e.preventDefault();
            let file_url = URL.createObjectURL(e.target.files[0]);
            $('#staff_add_form #add_image').attr('src', file_url);
        });

        /**
         * add staff
         */
        $(document).on('submit', '#staff_add_form', function(e){
            e.preventDefault();
            let name = $('#staff_add_form input[name="name"]').val();
            let email = $('#staff_add_form input[name="email"]').val();
            let cell = $('#staff_add_form input[name="cell"]').val();
            let uname = $('#staff_add_form input[name="uname"]').val();
            let password = $('#staff_add_form input[name="password"]').val();
            let age = $('#staff_add_form input[name="age"]').val();
            let photo = $('#staff_add_form input[name="photo"]').val();

            if(name === '' || email === '' ||uname === '' || password === ''){
                message('Field must not be empty', '.staff_add_message');
            }else if(validateEmail(email) == false){
                message('Invalid email address', '.staff_add_message');
            }else if(uname.length < 2){
                message('Username at least 2 character', '.staff_add_message', 'warning');
            }else if(password.length < 3){
                message('Password at least 3 character', '.staff_add_message');
            }else{
                $.ajax({
                    url     : 'staff/store',
                    method  : "POST",
                    data    : new FormData(this),
                    contentType: false,
                    processData: false,
                    success : function(data){
                        $('#staff_add_form')[0].reset();
                        $('#staff_add_modal').modal('hide');
                        $('#staff_add_form #add_image').attr('src', '#');
                        getStaff();
                    }
                });
            }

        });

        /**
         * get all staff data
         */
        getStaff();
        function getStaff(){
            $.ajax({
                url: 'staff/show',
                success: function(data){
                    $('#show_staff').html(data);
                }
            });
        }

        /**
         * view single staff data
         */
        $(document).on('click', '#view_staff', function(e){
            e.preventDefault();
            let staff_id = $(this).data('staff_id');
            $.ajax({
                url: 'staff/view/'+staff_id,
                success: function(data){
                    $('#single_staff_data').html(data);
                    $('#staff_show_modal').modal('show');
                }
            });
        });

        /**
         * show last selected image while update
         */
        $(document).on('change', '#staff_edit_form #new_photo', function(e){
            e.preventDefault();
            let file_url = URL.createObjectURL(e.target.files[0]);
            $('#staff_edit_form #photo-show').attr('src', file_url);
        });

        /**
         * edit student show
         */
        $(document).on('click', '#edit_staff', function(e){
            e.preventDefault();
            let staff_id = $(this).data('staff_id');
            $.ajax({
                url: 'staff/'+staff_id+'/edit',
                success: function(data){
                    let parseJson = $.parseJSON(data);
                    $('#staff_edit_form #name').val(parseJson.name);
                    $('#staff_edit_form #email').val(parseJson.email);
                    $('#staff_edit_form #cell').val(parseJson.cell);
                    $('#staff_edit_form #uname').val(parseJson.uname);
                    $('#staff_edit_form #age').val(parseJson.age);
                    $('#staff_edit_form #photo-show').attr('src', '../media/staff/'+parseJson.photo);
                    $('#staff_edit_form #old_photo').val(parseJson.photo);
                    $('#staff_edit_form').attr('data-staff_id', parseJson.id);
                    $('#staff_edit_modal').modal('show');
                }
            });
        });


        /**
         * edit student data
         */
        $(document).on('submit', '#staff_edit_form', function(e){
            e.preventDefault();

            let staff_id = $(this).data('staff_id');
            let name = $('#staff_edit_form input[name="name"]').val();
            let email = $('#staff_edit_form input[name="email"]').val();
            let cell = $('#staff_edit_form input[name="cell"]').val();
            let uname = $('#staff_edit_form input[name="uname"]').val();
            let password = $('#staff_edit_form input[name="password"]').val();
            let age = $('#staff_edit_form input[name="age"]').val();
            let photo = $('#staff_edit_form input[name="photo"]').val();

            if(name === '' || email === '' ||uname === '' || password === ''){
                message('Field must not be empty', '.staff_edit_message');
            }else if(validateEmail(email) == false){
                message('Invalid email address', '.staff_edit_message');
            }else if(uname.length < 2){
                message('Username at least 2 character', '.staff_edit_message', 'warning');
            }else{
                $.ajax({
                    url: 'staff/update/'+staff_id,
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(){
                        getStaff();
                        $('#staff_edit_modal').modal('hide');
                    }
                });
            }
        });

        /**
         * delete staff
         */
        $(document).on('click', '#delete_staff', function(e){
            e.preventDefault();
            let staff_id = $(this).data('staff_id');
            let con = confirm('Are u sure to delete?');
            if(con === true){
                $.ajax({
                    url: 'staff/destroy/'+staff_id,
                    success: function(){
                        getStaff();
                        message('Staff deleted successful', '.message', 'success');
                    }
                });
            }
        });

        /**
         * show last selected image
         */
        $(document).on('change', '#teacher_add_form #photo', function(e){
            e.preventDefault();
            let file_url = URL.createObjectURL(e.target.files[0]);
            $('#teacher_add_form #add_image').attr('src', file_url);
        });

        /**
         * add staff
         */
        $(document).on('submit', '#teacher_add_form', function(e){
            e.preventDefault();
            let name = $('#teacher_add_form input[name="name"]').val();
            let email = $('#teacher_add_form input[name="email"]').val();
            let cell = $('#teacher_add_form input[name="cell"]').val();
            let uname = $('#teacher_add_form input[name="uname"]').val();
            let password = $('#teacher_add_form input[name="password"]').val();
            let age = $('#teacher_add_form input[name="age"]').val();
            let photo = $('#teacher_add_form input[name="photo"]').val();

            if(name === '' || email === '' ||uname === '' || password === ''){
                message('Field must not be empty', '.teacher_add_message');
            }else if(validateEmail(email) == false){
                message('Invalid email address', '.teacher_add_message');
            }else if(uname.length < 2){
                message('Username at least 2 character', '.teacher_add_message', 'warning');
            }else if(password.length < 3){
                message('Password at least 3 character', '.teacher_add_message');
            }else{
                $.ajax({
                    url     : 'teacher/store',
                    method  : "POST",
                    data    : new FormData(this),
                    contentType: false,
                    processData: false,
                    success : function(data){
                        $('#teacher_add_form')[0].reset();
                        $('#teacher_add_modal').modal('hide');
                        $('#teacher_add_form #add_image').attr('src', '#');
                        getTeacher();
                    }
                });
            }

        });

        /**
         * get all teacher data
         */
        getTeacher();
        function getTeacher(){
            $.ajax({
                url: 'teacher/show',
                success: function(data){
                    $('#show_teacher').html(data);
                }
            });
        }


        /**
         * view single teacher data
         */
        $(document).on('click', '#view_teacher', function(e){
            e.preventDefault();
            let teacher_id = $(this).data('teacher_id');
            $.ajax({
                url: 'teacher/view/'+teacher_id,
                success: function(data){
                    $('#single_teacher_data').html(data);
                    $('#teacher_show_modal').modal('show');
                }
            });
        });


        /**
         * edit teacher show
         */
        $(document).on('click', '#edit_teacher', function(e){
            e.preventDefault();
            let teacher_id = $(this).data('teacher_id');
            $.ajax({
                url: 'teacher/'+teacher_id+'/edit',
                success: function(data){
                    let parseJson = $.parseJSON(data);
                    $('#teacher_edit_form #name').val(parseJson.name);
                    $('#teacher_edit_form #email').val(parseJson.email);
                    $('#teacher_edit_form #cell').val(parseJson.cell);
                    $('#teacher_edit_form #uname').val(parseJson.uname);
                    $('#teacher_edit_form #age').val(parseJson.age);
                    $('#teacher_edit_form #photo-show').attr('src', '../media/teacher/'+parseJson.photo);
                    $('#teacher_edit_form #old_photo').val(parseJson.photo);
                    $('#teacher_edit_form').attr('data-teacher_id', parseJson.id);
                    $('#teacher_edit_modal').modal('show');
                }
            });
        });

        /**
         * show last selected image while update
         */
        $(document).on('change', '#teacher_edit_form #new_photo', function(e){
            e.preventDefault();
            let file_url = URL.createObjectURL(e.target.files[0]);
            $('#teacher_edit_form #photo-show').attr('src', file_url);
        });

        /**
         * edit teacher data
         */
        $(document).on('submit', '#teacher_edit_form', function(e){
            e.preventDefault();

            let teacher_id = $(this).data('teacher_id');
            let name = $('#teacher_edit_form input[name="name"]').val();
            let email = $('#teacher_edit_form input[name="email"]').val();
            let cell = $('#teacher_edit_form input[name="cell"]').val();
            let uname = $('#teacher_edit_form input[name="uname"]').val();
            let password = $('#teacher_edit_form input[name="password"]').val();
            let age = $('#teacher_edit_form input[name="age"]').val();
            let photo = $('#teacher_edit_form input[name="photo"]').val();

            if(name === '' || email === '' ||uname === '' || password === ''){
                message('Field must not be empty', '.teacher_edit_message');
            }else if(validateEmail(email) == false){
                message('Invalid email address', '.teacher_edit_message');
            }else if(uname.length < 2){
                message('Username at least 2 character', '.teacher_edit_message', 'warning');
            }else{
                $.ajax({
                    url: 'teacher/update/'+teacher_id,
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(){
                        getTeacher();
                        $('#teacher_edit_modal').modal('hide');
                    }
                });
            }
        });


        /**
         * delete teacher
         */
        $(document).on('click', '#delete_teacher', function(e){
            e.preventDefault();
            let teacher_id = $(this).data('teacher_id');
            let con = confirm('Are u sure to delete?');
            if(con === true){
                $.ajax({
                    url: 'teacher/destroy/'+teacher_id,
                    success: function(){
                        getTeacher();
                        message('Teacher deleted successful', '.message', 'success');
                    }
                });
            }
        });


    });
})(jQuery)
