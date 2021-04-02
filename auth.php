<?php


namespace chatpeer;

session_start();
require_once 'login.php';
use chatpeer\Login;

/**
 * Authentication
 *
 * PHP version 7.0
 */
class Auth 
{
    public $email = "";
    public $password="";
    public $errors="";

    public function __construct($e, $pw)
    {
        $this->email = $e;
        $this->password = $pw;
    }

    public function validate()
    {
        $e = $this->email ;
        $pw = $this->password;

        if ( $e != null && $pw != null) {
            # code...
            return true;
        }
        return false;
    }
    
    public function redirect($url)
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'].'/Project/chatApp/' . $url, true);
        exit;
    }

}

$errors = "";

if(isset($_POST['chat_login']))
{
    $user = new Auth($_POST['email'], $_POST['password']);

    if($user->validate())
    {
        $user_auth = Login::authenticate($user->email, $user->password);
        if ($user_auth) {
            
            $status_update = Login::updateLogin($user_auth->id);
             $_SESSION['chat_id'] = $user_auth->id;
             $user->redirect('messenger.php');
        }

         else
        {
            $errors = "email or password not match";
        }
       
    }
    else{
        $errors = "all filled is required";
    }
   
}