<?php
class Finca{
    private $id;
    private $id_usuario;
    private $nombre_finca;
    private $direccion;

    public function __construct()
    {
        $this->conexion = new Base();
    }
    public function listarFinca(int $userID):array
    {
        $estado = 0;
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT * FROM finca WHERE (id_usuario = :id_usuario) and (estado = :estado)";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id_usuario", $userID, PDO::PARAM_STR);
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
        }
    }
    public function retornarFinca(string $id):array
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT nit, nombre_finca, direccion FROM finca WHERE id = :id";
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
    public function insertarFinca(array $datos):bool
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "INSERT INTO finca (id_usuario, nit, nombre_finca, direccion) VALUES (:id, :nit, :nombre_finca, :direccion) ";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $datos[ 'id_usuario'], PDO::PARAM_STR);
            $stmn->bindParam(":nit", $datos['nit'], PDO::PARAM_STR);
            $stmn->bindParam(":nombre_finca", $datos['nombre_finca'], PDO::PARAM_STR);
            $stmn->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
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
    public function actualizarFinca(array $datos):bool
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE finca SET nit = :nit, nombre_finca = :nombre_finca, direccion = :direccion WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $datos['id'], PDO::PARAM_STR);
            $stmn->bindParam(":nit", $datos['nit'], PDO::PARAM_STR);
            $stmn->bindParam(":nombre_finca", $datos['nombre_finca'], PDO::PARAM_STR);
            $stmn->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
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
    public function eliminarFinca(string $id):bool
    {
        $estado = 1;
        try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE finca SET estado = :estado WHERE id = :id";
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
    public function mostrarFinca(string $id):array 
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT nombre_finca FROM finca WHERE id = :id";
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
}