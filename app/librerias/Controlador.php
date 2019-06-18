<?php
//Clase controlador principal
//se encarga de poder cargar los modelos y las vistas
class Controlador{
    //Cargar Modelo
    public function modelo($modelo)
    {
        //Carga modelo
        require_once('../app/modelos/' . $modelo .'.php');
        //Instanciar el modelo
        return new $modelo();
    }
    //Cargar Vista
    public function vista($vista, $datos = [])
    {
        //Chequear si el archivo vista existe 
        if(file_exists('../app/vistas/' . $vista .'.php')){
            require_once('../app/vistas/' . $vista .'.php');
        }else{
            //Si el archivo de la vista no existe
            die('La vista no existe');
        }
    }
}