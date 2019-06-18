<?php 
class Formatos{
    private $id;
    private $nombre;
    private $url;
    private $estado;

    public function __construct(){
     $this ->conexion = new Base();   
    }

    public function  listarFormatos():array{
        $estado = 0;
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT * FROM formatos WHERE estado_formatos = :estado";
            $stmn = $this->conexion->prepare($sql);
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
    public function  ConteoFormatos()
    {
      
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT MAX(id_formatos) from formatos ";
            
            $stmn = $this->conexion->prepare($sql);
            $stmn->execute();
            $this->conexion->commit();
            return $stmn->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();
            $this->conexion->rollBack();
        }
    }
    public function Agregarformatos(array $datos):bool{
        try{
            $this->conexion->beginTransaction();
            $sql = "INSERT INTO formatos (nombre_formatos,url_formatos) VALUES (:nombre_formatos,:url_formatos)";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam( ":nombre_formatos",$datos['nombre'],PDO::PARAM_STR);
            $stmn->bindParam( ":url_formatos", $datos['url'], PDO::PARAM_STR);
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

    public function  retornarFormato(string $name): array
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT nombre_formatos FROM formatos   WHERE id_formatos = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id",$name,PDO::PARAM_STR);
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
    public function eliminarFormato(string $id): bool
    {
        $estado = 1;
        try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE formatos SET estado_formatos = :estado WHERE id_formatos = :id";
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