<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/finca.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/crearfinca.css' ?>">
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

            include(RUTA_APP . '/vistas/navegacion/navegacion.php');
            ?>
        </div>
        <div class="contorno">
            <div class="contenedorFinca">
                <div class="finca">
                    <div class="finca1">
                        <h1>Fincas</h1>
                    </div>
                    <div class="finca2">
                        <div class="registrarFinca" ng-show="registrar ==='1'">
                            <div class="datosFinca">
                                <div class="tituloFinca">
                                    <center>
                                        <h1 class="titulocrearfinca">Crear Finca</h1></br>
                                    </center>
                                </div>
                                <div class="inputFinca">
                                    <form action="<?php echo RUTA_URL . 'florian/agregarFinca' ?>" method="POST">
                                        <center>
                                            <p class="label">Nit</p>
                                        </center>
                                        <center><input class="ingresarDatos" placeholder="Nit Finca" name="nit" required=""></center>
                                        <center>
                                            <p class="label">Nombre</p>
                                        </center>
                                        <center><input class="ingresarDatos" placeholder="Nombre Finca" name="nombre_finca" required=""></center>
                                        <center>
                                            <p class="label">Dirección</p>
                                        </center>
                                        <center><input class="ingresarDatos" placeholder="Dirección Finca" name="direccion" required=""></center>
                                        <center><input class="botonMas" type="submit" class="botonesinputfinca" value="Aceptar">

                                    </form>
                                    <div>
                                        <?php if (!empty($datos)) {
                                            echo $datos;
                                        }

                                        ?>
                                    </div>
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