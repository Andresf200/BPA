<?php
//Clase para conectarse a la base de datos y ejecutar consultas
class Base extends PDO{
    private $host    =  DB_HOST;
    private $user    =  DB_USUARIO;
    private $pass    =  DB_PASSWORD;
    private $dbname  =  DB_NOMBRE;
    private $charset =  DB_CHARSET;
    private $port    =  DB_PORT;
    
    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset};port={$this->port}";
            parent::__construct($dsn, $this->user, $this->pass, array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES   => FALSE
        )); 
        } catch (\PDOException $ex) {
            print $ex->getMessage();
            print $ex->getCode();
            print_r($ex->getTrace());
            print $ex->getLine();   
        }
    }
}