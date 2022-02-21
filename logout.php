<?php

session_start();

require_once 'error.php';

unset($_SESSION['userName']); 
unset($_SESSION['userEmail']);

header('location:index.php');


?>

