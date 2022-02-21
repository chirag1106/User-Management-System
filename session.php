<?php

session_start();

require_once 'error.php';
require_once 'auth.php';

$cuser = new Auth();

if(!isset($_SESSION['userName']) && !isset($_SESSION['userEmail'])){
    header('location: index.php');
    die;
}
else{
    $cemail = $_SESSION['userEmail'];
    $cname = $_SESSION['userName'];

    $data = $cuser->currentUser($cemail);

}




?>
