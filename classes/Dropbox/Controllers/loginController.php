<?php

namespace Dropbox\Controllers;

use Common\Authentication;
use ZxcvbnPhp\Zxcvbn;

require __DIR__ . '/../../../vendor/autoload.php';

class loginController
{

    private $usersTable;
    private $authentication;
    public function __construct(Authentication $authentication, $usersTable)
    {
        include __DIR__ . '/../../../includes/DatabaseConnection.php';
        $this->usersTable = $usersTable;
        $this->authentication = $authentication;
    }
    public function login(){

        $errors = [];
        if(!empty($_POST)){
            $valid = true;
            if (empty($_POST['email'])){
                $valid = false;
                $errors[] = 'email can not be empty';
            }
            if (empty($_POST['password'])){
                $valid = false;
                $errors[] = 'password can not be empty';
            }
            if($valid){
                if (count($this->usersTable->findById($_POST['email'])) == 0){
                    $valid = false;
                    $errors[] = 'no such email';
                }
                else if(!password_verify($_POST['password'], $this->usersTable->findById($_POST['email'])[0]['password'])){
                    echo $_POST['password'];
                    $valid = false;
                    $errors[] = 'wrong password';
                }
            }
            if ($valid){
                if (password_needs_rehash($this->usersTable->findById($_POST['email'])[0]['password'], PASSWORD_BCRYPT, ['cost'=>12])){
                    $newHash = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost'=>12]);
                    $data = ['set' => ['password' => $newHash], 'conditions' => ['username' => $_POST['email']]];
                    $this->usersTable->updateValuesInDb($data, 'update');
                }
                $user = $this->usersTable->findById($_POST['email'])[0];
                $this->authentication->logUser($user['username'], $user['password'], $user['id']);
                header("Refresh:0");
            }
        }

        return ['title' => 'login',
            'templates' => ['login' => ['template' => 'login.html.php', 'variables' => ['errors' => $errors]]]];
    }
    public function register(){
        $errors = [];
        $valid = true;
        if (!empty($_POST)){
            $valid = true;
            if (empty($_POST['email'])){
                $valid = false;
                $errors[] = 'email can not be empty';
            }
            elseif (count($this->usersTable->findById($_POST['email'])) > 0){
                $errors[] = 'email already exists';
                $valid = false;
            }
            elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $valid = false;
                $errors[] = 'invalid email';
            }
            if (empty($_POST['password'])){
                $valid = false;
                $errors[] = 'password can not be empty';
            }
            elseif ($_POST['password'] !== $_POST['password_repeat']){
                $valid = false;
                $errors[] = 'passwords do not match';
            }
            if ($valid){
                $zxcvbn = new Zxcvbn();
                $pass = $zxcvbn->passwordStrength($_POST['password']);
                if($pass['score'] < 4) {
                    $errors[] = 'password too weak';
                    $errors[] = $pass['feedback']['warning'];
                }
                else{
                    $uniqUserId = str_replace('.', '-', uniqid('', true));

                    $data = ['username' => $_POST['email'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'userId' => $uniqUserId];
                    $this->usersTable->insertIntoDb($data);
                    $this->authentication->logUser($_POST['email'], $this->usersTable->findById($_POST['email'])[0]['password'], $uniqUserId);
                    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
                    header('location: '. $actual_link);
                }
            }
        }
        return ['title' => 'register',
            'templates' => ['login' => ['template' => 'register.html.php', 'variables' => ['errors' => $errors]]]];
    }
    public function logout(){
        $this->authentication->logout();
    }
}