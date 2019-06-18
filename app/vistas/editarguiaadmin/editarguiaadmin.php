<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style2.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/navegacionadmin.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/editarguia.css' ?>">

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
            <div class="contornoeditguia">

                <div class="contornofromguia">
                    <div class="titulofromguia">
                        <center>
                            <h1 class="tituloadminpaginas">Editar Guia</h1>
                        </center>
                    </div>
                    <div class="datosfromguia">
                        <form class="fromguia" action="<?php echo RUTA_URL . 'enrutador/actualizarGuiaAdmin' ?>" method="POST">
                            <center>
                                <h2 class="tituloeditguia">Ingrese los datos a editar</h2>
                            </center>
                            <input type="hidden" name="id" value="<?php echo $datos['id'] ?>">
                            <center>
                                <p class="label">Titulo</p>
                            </center>
                            <center><input class="inputfromguia" placeholder="Titulo" name="titulo" value="<?php echo $datos['titulo'] ?>"></center>
                            <center>
                                <p class="label">Contenido</p>
                            </center>
                            <center><textarea class="texfromguia" placeholder="Contenido" name="contenido" value="<?php echo $datos['contenido'] ?>"></textarea></center>
                            <p><?php
                                if (!empty($datos['error']))
                                    echo $datos['error'];
                                ?> </p>
                            <center><button type="submit" class="botonfromguia">Agregar</button></center>
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