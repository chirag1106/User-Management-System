<?php
require_once 'error.php';
require_once 'database.php';

class Auth extends Database{

    // Register New user
    public function register($name,$email,$password){
        $sql = 'INSERT INTO users (name,email,password) VALUES (:name,:email,:password)';

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam('name',$name);
        $stmt->bindParam('email',$email);
        $stmt->bindParam('password',$password);
        $stmt->execute();
        return true;
    }

    // Check if user already registered
    public function userExist($email){
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}




?>