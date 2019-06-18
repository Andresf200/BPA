<?php
class Encriptacion
{
    public function __construct()
    {
        $this->conexion = new Base();
    }
    public function encrytando($password): string
    {
        $hast = password_hash($password, PASSWORD_ARGON2I);
        return $hast;
    }
    public function validar($password, $bd):bool
    {
        if (password_verify($password, $bd[0]->contrasena)) { 
            return true;
        }else {
           
            return false;
        }
    }
}
