<?php
session_start();

require_once 'error.php';

// echo 'hello';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <!-- Custom CSS  -->
    <link rel="stylesheet" href="./css/style.css" />
</head>
<body class="bg-info">
    <div class="container">
        <!-- Reset Password Form Start -->
        <div class="row justify-content-center wrapper">
            <div class="col-lg-10 my-auto myShadow">
                <div class="row">
                    <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4 rounded-left">
                        <h1 class="text-center font-weight-bold text-white">Reset Your Password Here!</h1>
                        
                    </div>
                    <div class="col-lg-7 bg-white p-4" style="flex-grow: 2;">
                        <h1 class="text-center font-weight-bold text-primary rounded-right">Enter New Password!</h1>
                        <hr class="my-3" />
                        <form action="#" method="post" class="px-3">
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                                </div>
                                <input type="password" id="password" name="password" class="form-control rounded-0" minlength="5" placeholder="New Password" autocomplete="off" required  />
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                                </div>
                                <input type="password" id="password" name="cpassword" class="form-control rounded-0" minlength="5" placeholder="Confirm New Password" autocomplete="off" required  />
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Reset Password" class="btn btn-primary btn-lg btn-block myBtn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reset Password Form End -->
    </div>

     <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    
    <!-- Jquery CDN -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <!-- Font Awesome CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>


</body>
</html>