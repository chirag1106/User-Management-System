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

    echo 'login';



}
else{
    header('location:index.php');
}




?>