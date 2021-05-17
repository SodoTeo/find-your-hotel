<?php 
    require 'mailsender.php';
?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <link rel="stylesheet" href="css/login.css">
            <title>Authentification</title>
            <script language="javascript" type="text/javascript">
                function submitlogin() {
                    var form = document.login;
                    if (form.emailusername.value == "") {
                        alert("Enter email or username.");
                        return false;
                    } else if (form.password.value == "") {
                        alert("Enter Password.");
                        return false;
                    }
                }
                function submitreg() {
                    var form = document.reg;
                    if (form.name.value == "") {
                        alert("Enter Name.");
                        return false;
                    } else if (form.uname.value == "") {
                        alert("Enter username.");
                        return false;
                    } else if (form.upass.value == "") {
                        alert("Enter Password.");
                        return false;
                    } else if (form.uemail.value == "") {
                        alert("Enter email.");
                        return false;
                    }
                }
            </script>
        </head>
        <body>
            <?php
                if(isset($_GET["register"]))
                {
                    if($_GET["register"] == 'success')
                    {
                        echo '
                            <script>alert("Email Successfully verified, Registration Process Completed...")</script>
                            ';
                    }
                }
            ?>
            <div class="login-reg-panel">
                    <div class="login-info-box">
                        <h2>Have an account?</h2>
                        <p>Login and list your Hotel!</p>
                        <label id="label-register" for="log-reg-show">Login</label>
                        <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
                    </div>                   
                    <div class="register-info-box">
                        <h2>Don't have an account?</h2>
                        <p>Sign up and list your Hotel!</p>
                        <label id="label-login" for="log-login-show">Register</label>
                        <input type="radio" name="active-log-panel" id="log-login-show">
                    </div>
                    <form action="" method="post" name="login" id="login_form">
                        <div class="white-panel">
                            <div class="login-show">
                                <h2>LOGIN</h2>
                                <input type="text" name="user_email" placeholder="Username" value="joyom35894@httptuan.com" required>
                                <input type="password" name="user_password" placeholder="Password" value="admin123@" required>
                                <input type="hidden" name="action" id="action" value="email" />
                                <button type="submit" name="next" id="next" value="Login" >Login</button>
                                <p style="text-align: center; font-size: 14px;"><a href="../index.php">Back To Home</a></p>
                            </div>
                    </form>
                    <form action="" method="post" name="reg" >
                        <div class="register-show">
                            <h2>REGISTER</h2>
                            <input type="text" placeholder="Username" name="user_name" required>
                            <input type="text" placeholder="Email" name="user_email" required>
                            <input type="password" placeholder="Password" name="user_password" required >
                            <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                            <button type="submit" class="btn btn-lg btn-primary button" name="register" value="sign-up">Register</button>
                            </br>
                            <p style="text-align: center; font-size: 14px;"><a href="../index.php">Back To Home</a></p>
                        </div>
                    </form>
            </div>
            <script>

                $(document).ready(function(){
                    $('.login-info-box').fadeOut();
                    $('.login-show').addClass('show-log-panel');
                });

                $('.login-reg-panel input[type="radio"]').on('change', function() {
                    if($('#log-login-show').is(':checked')) {
                        $('.register-info-box').fadeOut(); 
                        $('.login-info-box').fadeIn();
                        
                        $('.white-panel').addClass('right-log');
                        $('.register-show').addClass('show-log-panel');
                        $('.login-show').removeClass('show-log-panel');
                
                    }
                    else if($('#log-reg-show').is(':checked')) {
                        $('.register-info-box').fadeIn();
                        $('.login-info-box').fadeOut();
                        
                        $('.white-panel').removeClass('right-log');
                        
                        $('.login-show').addClass('show-log-panel');
                        $('.register-show').removeClass('show-log-panel');
                    }
                });
        
            </script>
            <script>

                $(document).ready(function(){
                    $('#login_form').on('submit', function(event){
                        event.preventDefault();
                        var action = $('#action').val();
                        $.ajax({
                            url:"../otp-php-registration/login_verify.php",
                            method:"POST",
                            data:$(this).serialize(),
                            dataType:"json",

                            success:function(data)
                            {
                                $('#next').attr('disabled', false);

                                if(action == 'password')
                                {
                                    if(data.error != '')
                                    {
                                        $('#user_password_error').text(data.error);
                                    }
                                    else
                                    { 
                                        window.location.replace("../admin.php");
                                    }
                                }
                                $('#action').val(data.next_action);
                            }
                        })
                    });
                });

            </script>
	    </body>
</html>