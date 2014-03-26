$(document).ready(function() {
    $('#bill_1').change(function(){
       mycallback($(this).is(':checked'),1);
});
    mycallback($('#bill_1').is(':checked'),1);

    $('#userForm #_btnsubmit').on('click', function() {
        var email = $('#userForm #email').val();
        var nick = $('#userForm #nick').val();
        var id = $('#userForm #user_id').val();
        console.log(id);
        $('.error').hide();
        var error = false;
        $.getJSON("/user/checkRegister", {email: email, nick: nick, user_id: id}, function(data) {
            if (data != null) {
                $.each(data, function(i, item) {
                    $('#userForm #error_' + item).show();
                    error = true;
                });
            }
            if (!error) {
            $('#userForm').submit();
            }
        });
   
    return false;
    });
});