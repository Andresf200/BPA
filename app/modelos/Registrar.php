<?php
class Registrar{
    private $id;
    private $nombre;
    private $telefono;
    private $usuario;
    private $id_rol;

    public function __construct()
    {
        $this->conexion = new Base();
    }
    public function insertarRegistrar(array $datos):bool
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "INSERT INTO usuario (nombre, correo, telefono, usuario,contrasena) VALUES (:nombre, :correo, :telefono, :usuario,:contrasena)";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(':nombre',$datos['nombre'], PDO::PARAM_STR);
            $stmn->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmn->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
            $stmn->bindParam(':usuario', $datos['usuario'], PDO::PARAM_STR);
            $stmn->bindParam(':contrasena',$datos['contrasena'], PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            if ($stmn->rowCount()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getFile();
            $this->conexion->rollBack();
            return false;
        }
    }
}