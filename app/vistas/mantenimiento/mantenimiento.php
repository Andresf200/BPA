<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/guias.css' ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/guiasMantenimiento.css' ?>">
         
    </head>
    
    <body>
        <div class="contenedor">
            <div class="superior">               
                <?php 
                require(RUTA_APP . '/vistas/superior/superior.php');
                ?>
            </div>
            <div class="navegacion">
                <?php 
                require(RUTA_APP . '/vistas/navegacion/navegacion.php');
                ?>
            </div>
            <div class="contorno">
                <div class="contenedorGuias">
            <div class="guias">
                <div class="guias1">
                    <?php 
                    require(RUTA_APP . '/vistas/navegacionguia/navegacionguia.php');
                   
                ?>
                </div>
                <div class="guias2">
                    <div class="contornomantenimiento" ng-show="mante === '1'">
                        <div class="mantenimientoTitulo">
                            <center><h1 class="tituloMantenimiento">Mantenimiento</h1></center>
                        </div>
                            <div class="mantenimientoInfo">
                                <div class="mantenimientoInfotext">
                                <?php
                                    print_r($datos['contenido']);
                                ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
                </div>
            </div>  
            <div class="inferior">
                <?php 
                require(RUTA_APP . '/vistas/inferior/inferior.php');
                ?>
            </div>
     </div>
    </body>
</html>
