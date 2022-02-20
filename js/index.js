$(document).ready(function(){
    $('#register-link').click(function(){
        $('#login-box').hide();
        $('#register-box').show();
    });

    $("#login-link").click(function () {
        $("#login-box").show();
        $("#register-box").hide();
    });

    $("#forgot-link").click(function () {
        $("#login-box").hide();
        $("#forgot-box").show();
    });

    $("#back-link").click(function () {
        $("#login-box").show();
        $("#forgot-box").hide();
    });

    // Register AJAX request
    $('#register-btn').click(function(e){
        if($('#register-form')[0].checkValidity())
        {
            e.preventDefault();
            $('#register-btn').val('Please Wait...');
            if($('#rpassword').val() != $('#cpassword').val())
            {
                $('#passError').text('*Password did not matched!');
                $('#register-btn').val('Sign Up');
            }
            else
            {
                $('#passError').text('');
                $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: $('#register-form').serialize()+'&action=register',
                    success: function(response)
                    {
                        $('#register-btn').val('Sign Up');
                        if(response === 'register')
                        {
                            window.location = 'home.php';
                        }
                        else
                        {
                            $('#regAlert').html(response);
                        }
                    }
                });
            }
        }
    });

    // Login AJAX request
    $('#login-btn').click(function(e){
        if($('#login-form')[0].checkValidity())
        {
            e.preventDefault();
            $('#login-btn').val('Please wait...');
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: $('#login-form').serialize()+'&action=login',
                success: function(response)
                {
                    $('#login-btn').val('Sign In');
                    if(response === 'login')
                    {
                        window.location = 'home.php';
                    }
                    else
                    {
                        $('#loginAlert').html(response);
                    }
                }   
            });
        }
    });

    // Forget AJAX request
});