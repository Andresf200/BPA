<?php
class Eliminar
{
    public function __construct()
    {
        $this->conexion = new Base();
    }
    public function eliminar(string $name)
    {
        $run =  exec("del ".DIRECTORIO .$name);
      
    }
}
?>
