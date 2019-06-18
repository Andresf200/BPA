<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style2.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/navegacionadmin.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/crearguia.css' ?>">

</head>

<body>
    <div class="contenedoradmin">

        <div class="superioradmin">
            <?php
            require(RUTA_APP . '/vistas/superioradmin/superioradmin.php');
            ?>
        </div>

        <div class="administrador">
            <center>
                <h1 class="tituloadmin">Interfaz Administrador</h1>
            </center>
        </div>

        <div class="navegacionadmin">
            <?php
            require(RUTA_APP . '/vistas/navegacionadmin/navegacionadmin.php');
            ?>
        </div>

        <div class="contornoadmin">
            <div class="contornocrearguia">

                <div class="contornofromcrearguia">
                    <div class="titulofromcrearguia">
                        <center>
                            <h1 class="tituloadminpaginas">Editar</h1>
                        </center>
                    </div>
                    <div class="datosfromcrearguia">
                        <form class="fromcrearguia" action="<?php echo RUTA_URL . 'enrutador/Actualizartip' ?>" method="POST">
                            <center>
                                <h2 class="titulocrearguia">Ingrese los datos del nuevo tip</h2>
                            </center>

                            <center><input type="hidden" class="inputfromcrearguia" placeholder="Titulo Tips" name="id" value="<?php echo $datos['id'] ?>"></center>
                            <center>
                                <p class="label">Titulo</p>
                            </center>
                            <center><input class="inputfromcrearguia" placeholder="Titulo Tips" name="titulo" value="<?php echo $datos['nombre'] ?>"></center>
                            <center>
                                <p class="label">Contenido</p>
                            </center>
                            <center><textarea class="textfromcrearguia" placeholder="contenido" name="contenido" value="<?php echo $datos['contenido'] ?>"></textarea></center>
                            <center><input type="hidden" class="inputfromcrearguia" placeholder="Titulo Tips" name="estado" value="1"></center>
                            <p><?php if (!empty($datos['error'])) {
                                    echo $datos['error'];
                                } ?></p>
                            <center><button type="submit" class="botonfromcrearguia">Aceptar</button></center>
                        </form>

                    </div>
                </div>

            </div>
        </div>



        <div class="inferioradmin">
            <?php
            require(RUTA_APP . '/vistas/inferioradmin/inferioradmin.php');
            ?>
        </div>
    </div>
</body>

</html>