<?php
class Evento
{
    private $id;
    private $id_finca;
    private $titulo;
    private $fecha;
    private $descripcion;

    public function __construct()
    {
        $this->conexion = new Base();
    }
    public function listarEvento(string $id): array
    {
        $estado = 0;
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT * FROM evento WHERE (id_finca = :id_finca) and (estado = :estado)";
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
    public function retornarEvento(string $id): array
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "SELECT titulo,fecha,descripcion FROM evento WHERE id = :id";
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
    public function insertarEvento(array $datos): bool
    {
        try {
            $this->conexion->beginTransaction();
            $sql = "INSERT INTO evento (id_finca, titulo, fecha, descripcion) VALUES (:id_finca, :titulo, :fecha, :descripcion)";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id_finca", $datos['id_finca'], PDO::PARAM_STR);
            $stmn->bindParam( ":titulo", $datos[ 'titulo'], PDO::PARAM_STR);
            $stmn->bindParam( ":fecha", $datos[ 'fecha'], PDO::PARAM_STR);
            $stmn->bindParam( ":descripcion", $datos['descripcion'], PDO::PARAM_STR);
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

    public function actualizarEvento(array $datos): bool
    {
     
        try {

            $this->conexion->beginTransaction();
            $sql = "UPDATE evento SET titulo = :titulo, fecha = :fecha,descripcion = :descripcion WHERE id = :id";
            $stmn = $this->conexion->prepare($sql);
            $stmn->bindParam(":id", $datos['id'], PDO::PARAM_STR);
            $stmn->bindParam( ":titulo", $datos[ 'titulo'], PDO::PARAM_STR);
            $stmn->bindParam( ":fecha", $datos[ 'fecha'], PDO::PARAM_STR);
            $stmn->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
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
    public function eliminarEvento(string $id): bool
    {
        $estado = 1;
        try {
            $this->conexion->beginTransaction();
            $sql = "UPDATE evento SET estado = :estado WHERE id = :id";
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

