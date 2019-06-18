<?php
class Cultivo{
    private $id;
    private $id_finca;
    private $id_tipo_cultivo;
    private $area;
    private $descripcion;

    public function __construct()
    {
        $this->conexion = new Base();
    }
    public function listarCultivos(string $id):array
    {
        $estado  = 0; 
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT * FROM cultivo WHERE (id_finca = :id_finca) and (estado = :estado)";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id_finca", $id, PDO::PARAM_STR);
            $stmn->bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            return $stmn->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getline();
            $this->conexion->rollBack();
        }
    }
    public function retornarCultivo(string $id):array 
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT id_tipo_cultivo,area,descripcion FROM cultivo WHERE id = :id ";
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
    public function insertarCultivo(array $datos):bool
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "INSERT INTO cultivo (id_finca, id_tipo_cultivo, area, descripcion) VALUES (:id_finca, :id_tipo_cultivo, :area, :descripcion)";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id_finca", $datos[ 'id_finca'], PDO::PARAM_STR);
            $stmn->bindParam(":id_tipo_cultivo", $datos['id_tipo_cultivo'], PDO::PARAM_STR);
            $stmn->bindParam(":area", $datos['area'], PDO::PARAM_STR);
            $stmn->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            if($stmn->rowCount()){
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

    public function actualizarCultivo(array $datos):bool
    {
        try {
          
            $this->conexion->beginTransaction();
            $sql = "UPDATE cultivo SET id_tipo_cultivo = :id_tipo_cultivo, area = :area,descripcion = :descripcion WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $datos['id'], PDO::PARAM_STR);
            $stmn->bindParam( ":id_tipo_cultivo", $datos[ 'id_tipo_cultivo'], PDO::PARAM_STR);
            $stmn->bindParam(":area", $datos[ 'area'], PDO::PARAM_STR);
            $stmn->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            if($stmn->rowCount()){
                return true;
            }else{
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
    public function eliminarCultivo(string $id):bool
     {  
         $estado = 1;
        try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE cultivo SET estado = :estado WHERE id = :id";
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