<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style2.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/navegacionadmin.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/editarusuario.css' ?>">
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
            <div class="contornocrearusuario">

                <div class="contornofromusuario">
                    <div class="titulofromusuario">
                        <center>
                            <h1 class="tituloadminpaginas">Editar Ususario</h1>
                        </center>
                    </div>
                    <div class="datosfromusuario">
                        <form class="fromusuario" action="<?php echo RUTA_URL . 'enrutador/actualizarAdmin' ?>" method="POST">
                            <center>
                                <h2 class="titulocrearadmin">Ingrese los datos a editar</h2>
                            </center>
                            <input type="hidden" name="id" value="<?php echo $datos['id'] ?>">
                            <center>
                                <p class="label">Nombre</p>
                            </center>
                            <center><input class="inputfromusuario" name="nombre" value="<?php echo $datos['nombre'] ?>"></center>
                            <center>
                                <p class="label">Teléfono</p>
                            </center>
                            <center><input class="inputfromusuario" name="telefono" value="<?php echo $datos['telefono'] ?>"></center>
                            <center>
                                <p class="label">Usuario</p>
                            </center>
                            <center><input class="inputfromusuario" name="usuario" value="<?php echo $datos['usuario'] ?>"></center>
                            <center>
                                <p class="label">Contraseña</p>
                            </center>
                            <center><input class="inputfromusuario" name="contrasena" value="<?php echo $datos['contrasena'] ?>"></center>
                            <p><?php
                                if (!empty($datos['error']))
                                    echo $datos['error'];
                                ?></p>
                            <center><button type="submit" class="botonfromusuario">Aceptar</button></center>
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