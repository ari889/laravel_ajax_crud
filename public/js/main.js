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
                    url     : 'store',
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
                url: 'show',
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
                url: 'view/'+student_id,
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
               url: student_id+'/edit',
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
                   url: 'update/'+student_id,
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
                   url: 'destroy/'+student_id,
                   success: function(){
                       getStudent();
                       message('Student deleted successfull', '.message', 'success');
                   }
               });
           }
        });

    });
})(jQuery)
