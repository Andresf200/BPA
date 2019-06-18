<?php 
class Validar{
    public function ValidarEntero($data)
    {
        
        if(ctype_digit($data)){
            $data = (int)$data ;
            if(is_int($data)){
                $ent =  (filter_var($data, FILTER_SANITIZE_NUMBER_INT));
                return $ent;
            }else{
                return "false";
            }
        }else{
            return "este numero no es un entero";
        }
    }
public function ValidarFloat($data)
    {

        if (ctype_digit($data)) {
            $data = (float)$data;
            if (is_float($data)) {
                $float = (filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT));
                return $float;
            } else {
                return "false";
            }
        } else {
            return "este no es numero flotante";
        }
    }
public function ValidarIngresar($data)
{

    if (ctype_digit($data)) {
        $data = (int)$data;
        if (is_int($data)) {
        $ent = (filter_var($data, FILTER_SANITIZE_NUMBER_INT));
            return true;
        } else {
            return false;
        }
        } else {
            return false;
        }

}

public function ValidarInFloat($data)
{

    if (ctype_digit($data)) {
        $data = (float)$data;
        if (is_float($data)) {
            $float = (filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT));
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function ValidarFecha($fecha)
{
    $valores = explode('/', $fecha);
    if (count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])) {
        return true;
    }
    return false;
}
}