<?php
class Sesion{
    public function __construct()
    {
        session_start();
    }
    public function setCurrentUser($idUser)
    {
        $_SESSION['id'] = $idUser;
    }
    public function getCurrentUser()
    {
        return $_SESSION['id'];
    }
    public function closeSession()
    {
        session_unset();
        session_destroy();
    }
}