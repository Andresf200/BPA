<?php 
class Carrusel{
    private $id;
    private $nombre;
    private $contenido;
    private $estado;
    public function __construct()
    {
        $this->conexion = new Base();

    }
    public function listarCarrusel():array{
        try{
            $this->conexion->beginTransaction();
            $sql="SELECT * FROM carrusel WHERE estado = 0";
            $stmn = $this->conexion->prepare($sql);
            $stmn->execute();
            $this->conexion->commit();
            return $stmn->fetchAll(PDO::FETCH_OBJ);
        }catch(\PDOException $ex){
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();
            $this->conexion->rollBack();
        }

    }
    public function agregarTips(array $datos):bool{
    try{
        $this->conexion->beginTransaction();
        $sql="INSERT INTO carrusel (nombre,contenido) VALUES(:nombre,:contenido)";
        $stmn= $this->conexion->prepare($sql);
        $stmn->bindParam(":nombre",$datos['titulo'],PDO::PARAM_STR);
        $stmn->bindParam(":contenido",$datos['contenido'],PDO::PARAM_STR);
        $stmn->execute();
        $this->conexion->commit();
            if ($stmn->rowCount()) {
                return true;
            } else {
                return false;
            }
    }catch(\PDOException $ex){
        print $ex->getMessage();
        print $ex->getCode();
        print_r($ex->getTrace());
        print $ex->getLine();
        $this->conexion->rollBack();

    }
    }


    public function  retornarTips(string $id): array
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT * FROM carrusel WHERE id = :id ";
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
    public function  actualizarTips(array $datos): bool
    {
        $estado = 0;
        try {
         
            $this->conexion->beginTransaction();
            $sql = "UPDATE carrusel SET nombre = :nombre, contenido = :contenido,estado = :estado WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam( ":id", $datos['id'], PDO::PARAM_STR);
            $stmn->bindParam( ":nombre", $datos[ 'titulo'], PDO::PARAM_STR);
            $stmn->bindParam( ":contenido", $datos['contenido'], PDO::PARAM_STR);
            $stmn->bindParam( ":estado", $estado, PDO::PARAM_STR);
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
    public function eliminarTip(string $id): bool
    {
        $estado = 1;
        try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE carrusel SET estado = :estado WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $id, PDO::PARAM_STR);
            $stmn->bindParam(":estado", $estado, PDO::PARAM_STR);
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
            return false;
        }
    }
   




}
?>