<?php
//Para redireccionar la pagina
function redireccionar($paginas){
    header('Location:' . RUTA_URL.$paginas );
}