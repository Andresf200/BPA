<?php
class Guias {
    private $id;
    private $titulo;
    private $tipo;
    private $contenido;

    public function __construct()
    {
        $this->conexion = new Base();
    }
    public function listarGuias(int $id) : array
    {
        $estado = 0;
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT * FROM guia WHERE (tipo = :tipo) and (estado = :estado)";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":tipo", $id, PDO::PARAM_STR);
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
    public function listarGuiasAdmin(): array
    {
        $estado = 0;
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT * FROM guia WHERE estado = :estado";
            $stmn = $this->conexion->prepare($sql);
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
    public function retornarGuias( $id):array
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT id,titulo,tipo,contenido FROM guia WHERE id = :id";
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
    public function insertarGuias(array $datos)
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "INSERT INTO guia ( titulo, tipo, contenido) VALUES (:titulo, :tipo, :contenido )";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":titulo", $datos['titulo'], PDO::PARAM_STR);
            $stmn->bindParam(":tipo", $datos['tipo'], PDO::PARAM_STR);
            $stmn->bindParam(":contenido", $datos['contenido'], PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getFile();
            $this->conexion->rollBack();
         
        }
    }

    public function actualizarGuias(array $datos):bool
    {
        try {

            $this->conexion->beginTransaction();
            $sql = "UPDATE guia SET titulo = :titulo,contenido = :contenido WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $datos['id'], PDO::PARAM_STR);
            $stmn->bindParam( ":titulo", $datos[ 'titulo'], PDO::PARAM_STR);
            $stmn->bindParam( ":contenido", $datos[ 'contenido'], PDO::PARAM_STR);
            $stmn->execute();
            $this->conexion->commit();
            if( $stmn->rowCount()){ 
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
    public function eliminarGuias(string $id):bool
    {
        
        $estado = 1;
        try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE guia SET estado = :estado WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $id, PDO::PARAM_STR);
            $stmn->bindParam(":estado", $estado, PDO::PARAM_STR);
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
