<?php
class Usuario{
    private $id; //primaria
    private $nombre;
    private $telefono;
    private $usuario;
    private $contrasena;
    private $id_rol;

    public function __construct()
    {
        $this->conexion = new Base();
    }
    public function usuarioExiste($usuario)
    {
        $estado = 0;
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT contrasena FROM usuario WHERE usuario = :usuario and estado = :estado";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmn->bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            return $stmn->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();
            $this->conexion->rollBack();
            return false;
        }
    }
    public function retornoID($usuario):array 
    {
        $estado = 0;
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT id FROM usuario WHERE usuario = :usuario and estado = :estado";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmn->bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            return $stmn->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();
            $this->conexion->rollBack();
            return array();
        }

    }
    public function limpiarDatos($datos)
    {
        $datos = trim($datos);
        $datos = htmlspecialchars($datos);
        $datos = filter_var($datos, FILTER_SANITIZE_STRING);
        return $datos;
    }
    public function agregarUsuario(array $datos){
        try {
            $this->conexion->beginTransaction();
            $sql = "INSERT INTO usuario (nombre,telefono,usuario,contrasena,id_rol) VALUES (:nombre,:telefono,:usuario,:contrasena,:id_rol)";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
            $stmn->bindParam(":telefono",$datos['telefono'], PDO::PARAM_STR);
            $stmn->bindParam(":usuario",$datos['usuario'], PDO::PARAM_STR);
            $stmn->bindParam(":contrasena",$datos['contrasena'], PDO::PARAM_STR);
            $stmn->bindParam(":id_rol",$datos['id_rol'], PDO::PARAM_STR);
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
            print $ex->getLine();
            $this->conexion->rollBack();
            return array();
        }
    }
    public function retornarPermiso($userID)
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT id_rol FROM usuario WHERE id = :userID";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam( ":userID", $userID, PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            return $stmn->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();
            $this->conexion->rollBack();
        }
    }
    public function listarUsuario()
    {
        $estado = 0;
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT id,nombre,telefono,usuario,contrasena,id_rol FROM usuario WHERE estado = :estado";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":estado",$estado,PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            return $stmn->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();
            $this->conexion->rollBack();
        }
    }
    public function retornarUsuario($id)
    {
        try {
            $this->conexion->beginTransaction();
            $sql ="SELECT id,nombre,telefono,usuario,contrasena FROM usuario WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $id, PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            return $stmn->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();
            $this->conexion->rollBack();
        }
        
       
    }
    public function  actualizarUsario(array $datos){
        
         try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE usuario SET nombre = :nombre, telefono = :telefono,usuario = :usuario,contrasena = :contrasena WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $datos['id'], PDO::PARAM_STR);
            $stmn->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
            $stmn->bindParam(":telefono",$datos ['telefono'], PDO::PARAM_STR);
            $stmn->bindParam(":usuario",$datos ['usuario'], PDO::PARAM_STR);
            $stmn->bindParam(":contrasena",$datos ['contrasena'], PDO::PARAM_STR);
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
            print $ex->getLine();
            $this->conexion->rollBack();
            return array();
        }
    }
    public function eliminarUsuario(string $id):bool
     {
      
         $estado = 1;
        try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE usuario SET estado = :estado WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id",$id, PDO::PARAM_STR);
            $stmn->bindParam(":estado",$estado, PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            if ($stmn->rowCount()) {
                return true;
            }else{ 
                 return false;
            }
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();
            $this->conexion->rollBack();
            return false;
        }
    }
}