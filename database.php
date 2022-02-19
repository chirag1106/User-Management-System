<?php
require_once 'error.php';

class Database{
    private $dsn = 'mysql:host=127.0.0.1;dbname=user_system';
    private $dbUser = 'root';
    private $dbPass = '';

    public $con;

    public function __construct(){
        try{
            $this->con = new PDO($this->dsn,$this->dbUser,$this->dbPass);
        }
        catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
        return $this->con;
    }

    // Check user inputed data
    public function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    // Error Success Message Alert
    public function showMessage($type, $message){
        return '<div class="alert alert-'.$type.' alert-dismissible">
                    <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
                    <strong class="text-center">'.$message.'</strong>
                </div>';
    }
}


?>