<?php
require_once 'error.php';
require_once 'database.php';

class Auth extends Database{

    // Register New user
    public function register($name,$email,$password){
        $sql = 'INSERT INTO users (name,email,password) VALUES (:name,:email,:password)';

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);
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

    // Handle login ajax request
    public function login($email){
        $sql = 'SELECT name, email, password FROM users WHERE email = :email AND deleted != 0';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Current user in session
    public function currentUser($email, $name){
        $sql = 'SELECT * FROM users WHERE email = :email && name = :name && deleted != 0';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':name',$name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}




?>