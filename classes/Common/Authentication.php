<?php

namespace Common;

class Authentication
{
    private $userTable;
    private $usernameColumn;
    public $passwordColumn;

    public function __construct(DatabaseTable $userTable, $usernameColumn, $passwordColumn)
    {
        session_start();
        $this->userTable = $userTable;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
    }
    public function logUser($username, $password, $id)
    {
        session_regenerate_id();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id'] = $id;
    }
    public function logout(){
        session_destroy();
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
        header('location: '. $actual_link);
    }
    public function isLogged(){
        if (!isset($_SESSION['username'])){
            return false;
        }
        if(count($this->userTable->findById($_SESSION['username'])) === 0) {
            return false;
        }
        if ($_SESSION['password'] !== ($this->userTable->findById($_SESSION['username']))[0][$this->passwordColumn]){
            return false;
        }
        return true;
    }
}