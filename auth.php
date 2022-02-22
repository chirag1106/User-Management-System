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
    public function currentUser($email){
        $sql = 'SELECT * FROM users WHERE email = :email && deleted != 0';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Forgot Password
    public function forgotPassword($token, $email){
        $sql = "UPDATE users SET token = :token , token_expire = DATE_ADD(NOW(),INTERVAL 10 MINUTE) WHERE email = :email";
        $stmt  = $this->con->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        return true;
    }

    public function sendEmail($subject, $email, $message, $type){
        $template = $this->emailTemplate($subject, $email, $message, $type);
        $SENDGRID_API_KEY='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';
        $url  = 'https://api.sendgrid.com/v3/mail/send';
        $headers   = array(
            "Authorization: Bearer $SENDGRID_API_KEY",
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($template) );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function emailTemplate($subject, $email, $message, $type){
        $my_email = 'chirag.webdeveloper123@gmail.com';
        $my_name = 'Chirag Gupta';

        $template = array();
        if($type === 'forgot')
        {
            $template = array(
                'personalizations' => array(
                    array(
                        'to' => array(
                            array(
                                 'email' => $email
                            )
                        )
                    )
                ),
                'from' => array(
                    'email' => $my_email,
                    'name' => $my_name
                ),
                'subject' => $subject,
                'content' => array(
                     array(
                        'type' => 'text/html',
                        'value' => $message
                    )
                )
            );
        }
        else if($type == 'resetPass'){
            $template = array(
                'personalizations' => array(
                    array(
                        'to' => array(
                            array(
                                 'email' => $email
                            )
                        )
                    )
                ),
                'from' => array(
                    'email' => $my_email,
                    'name' => $my_name
                ),
                'subject' => $subject,
                'content' => array(
                     array(
                        'type' => 'text/html',
                        'value' => $message
                    )
                )
            );
        }
        else{
            $template = NULL;
        } 

        return $template; 
    }

    // Reset Password User Auth
    public function resetPassword($email, $token){
        $sql = 'SELECT id FROM users WHERE email = :email && token = :token && token != "" && token_expire > NOW() && deleted != 0';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':token',$token);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Update New Password
    public function updatePassword($password, $email){
        $sql = 'UPDATE users SET token = "" , password = :password WHERE email = :email && deleted != 0';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':password',$password);
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        return true;
    }
}




?>