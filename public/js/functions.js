// (function ($) {
//
// })(jQuery)

/**
 * message show
 * @param msg
 * @param where
 * @param type
 */
function message(msg, where, type = 'danger'){
    let warn = '';
    if(type === 'danger'){
        warn = '<strong>Stop!</strong>'
    }else if(type === 'warning'){
        warn = '<strong>Warning!</strong>'
    }else{
        warn = '<strong>Success!</strong>'
    }
    $(where).html('<p class="alert alert-'+type+'">'+warn+' '+msg+'. <button type="button" class="close" data-dismiss="alert">&times;</button></p>');
}


/**
 * email validation
 * @param email
 * @returns {boolean}
 */
function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
