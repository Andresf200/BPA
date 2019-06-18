<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/navegacionGuias.css' ?>">

</head>
<body ng-app="BPA" ng-controller="boton">
    <div class="contenedorBotonesG">
        <div class="botonesG">
                                                        
            <button class="buttonG" role="link" onclick="window.location='<?php echo RUTA_URL . 'mantenimiento/guiasMantenimiento' ?>'">Mantenimiento</button>
        </div>
        <div class="botonesG" >
                                                    
            <button class="buttonG" role="link" onclick="window.location='<?php echo RUTA_URL . 'guiacultivos/guiasCultivos' ?>'">Cultivos</button>
        </div>
        <div class="botonesG">                               
            <button class="buttonG" role="link" onclick="window.location='<?php echo RUTA_URL . 'eco/guiasEco' ?>'">Ecología</button>
        </div>
        <div class="botonesG">                                            
            <button class="buttonG" role="link" onclick="window.location='<?php echo RUTA_URL . 'documentacion/guiasDocumentacion' ?>'">Documentación</button>
        </div>
    </div>
    
    
</body>
</html>
