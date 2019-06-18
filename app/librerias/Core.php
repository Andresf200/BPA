<?php
/*
Traer la url ingresada en el navegador
    1-controlador
    2-metodo
    3-Parámetro

    Ejemplo: /articulos/actualizar/5
*/
class Core{
    protected $controladorActual = 'Enrutador'; //Controlador por defecto
    protected $metodoActual = 'index';  //Metodo actual INDEX
    protected $parametros = [];   //Parametro vacio

    //Constructor que se carga automaticamente
    public function __construct()
    {
        //print_r($this->getUrl());
        $url = $this->getUrl();
        //Buscar en controladores si el controlador existe
        if(file_exists('../app/controladores/' . ucwords($url[0]).'.php')){
            //si existe se setea se configura como controlador por defecto
            $this->controladorActual = ucwords($url[0]);

            //unset indice
            unset($url[0]);
        }
        //Requerir el controlador
        require_once('../app/controladores/' . $this->controladorActual . '.php');
        $this->controladorActual = new $this->controladorActual;

        //Chequear o verificar la segunda parte de la url que seria el metodo
        if(isset($url[1])){
            if(method_exists($this->controladorActual, $url[1])){
                //Chequeamos el metodo
                $this->metodoActual = $url[1];
                //Unset indice
                unset($url[1]);
            }
        }
        //Para probar traer metodo
        //echo $this->metodoActual;

        //Obtener los posibles parametros
        $this->parametros = $url ? array_values($url) : [];
        //llamar callback con parametros de arrays que se pasen por utl
        //se ponen en [] porque necesita solo dos parametros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }
    public function getUrl()
    {
        //echo $_GET['url']; //Todo lo que se ingrese en la url lo imprime
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url); //Aqui se estan pasando los valores de la url en un array
            return $url;
        }
    }
    
}
