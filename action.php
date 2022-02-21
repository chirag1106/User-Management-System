<?php

session_start();

require_once 'error.php';
require_once 'auth.php';

$user = new Auth();

// Handle Register AJAX request
if(isset($_POST['action']) && $_POST['action'] === 'register' && !empty($_POST['action']))
{
    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $password = $user->test_input($_POST['password']);

    $hashPass = password_hash($password,PASSWORD_DEFAULT);

    if($user->userExist($email))
    {
        echo $user->showMessage('warning','This E-mail is already registered!');
    }
    else
    {
        if($user->register($name,$email,$hashPass))
        {
           echo 'register';
           $_SESSION['userName'] = $name;
           $_SESSION['userEmail'] = $email;
        }
        else
        {
            echo $user->showMessage('danger','Something went wrong! <br><b>Try again after sometime!</b>');
        }
    }
}
// Handle Login AJAX request
else if(isset($_POST['action']) && $_POST['action'] === 'login' && !empty($_POST['action']))
{
    $email = $user->test_input($_POST['email']);
    $password = $user->test_input($_POST['password']);

    $loggedInUser = $user->login($email);

    if($loggedInUser != NULL){
        if(password_verify($password,$loggedInUser['password'],)){
            if(!empty($_POST['rem'])){
                setcookie('email',$email,time()+(30*24*60*60),'/');
                setcookie('password',$password,time()+(30*24*60*60),'/');
            }
            else{
                if(!isset($_COOKIE['email'])){setcookie('email','',1,'/');}
                if(!isset($_COOKIE['password'])){setcookie('password','',1,'/');}
            }
            echo 'login';
            $_SESSION['userName'] = $loggedInUser['name'];
            $_SESSION['userEmail'] = $email;
        }
        else{
            echo $user->showMessage('danger','Password is incorrect!');
        }
    }
    else{
        echo $user->showMessage('danger','You are not register! Register yourself');
    } 
}
// Handle AJAX forgot request
else if(isset($_POST['action']) && $_POST['action'] === 'forgot' && !empty($_POST['action']))
{
    $email = $user->test_input($_POST['email']);
    
    $userFound = $user->currentUser($email);
    if($userFound != NULL){
        $token = md5(uniqid());
        $token = str_shuffle($token);
        $user->forgotPassword($token, $email);

        try{
            $subject = 'Reset Password';
            $message = '<h3>Click the below link to reset your password <br>
            <a href="http://localhost/chirag/User-Management-System/reset-pass.php?$email='.$email.'&token='.$token.'">Reset Password</a>
            <br><br>Regards<br>Chirag Gupta</h3>';
            $emailType = 'forgot';
            $response = $user->sendEmail($subject, $email, $message, $emailType);
            if($response == NULL)
            {
                echo $user->showMessage('success','Email sent successfully!');
            }
            else{
                throw new Exception("Couldn't able to send email. Try again later!");
            }
        }
        catch(Exception $e){
            echo $user->showMessage('danger',$e->getMessage());
        }
    }
    else{
        echo $user->showMessage('danger','You are not register! Register yourself');
    }
}
else{
    header('location:index.php');
}




?>