(function ($) {
    $(document).ready(function(){

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
                        message('Student added successful', '.student_add_message', 'success');
                    }
                });
            }

        });


        function getStudent(){
            $.ajax({
                url: 'student/show',
                success: function(){

                }
            });
        }


    });
})(jQuery)
