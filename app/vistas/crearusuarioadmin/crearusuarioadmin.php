<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style2.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/navegacionadmin.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/crearadmin.css' ?>">
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
            <div class="contornocrearadmin" ng-show="crearadmin === '1'">

                <div class="contornofromadmin">
                    <div class="titulofromadmin">
                        <center>
                            <h1 class="tituloadminpaginas">Crear Admin</h1>
                        </center>
                    </div>
                    <div class="datosfromadmin">
                        <form class="fromadmin" action="<?php echo RUTA_URL . 'enrutador/agregarAdmin' ?>" method="POST">
                            <center>
                                <h2 class="titulocrearadmin">Ingrese los datos del nuevo administrador</h2>
                            </center>
                            <center>
                                <p class="label">Nombre</p>
                            </center>
                            <center><input class="inputfromadmin" placeholder="Nombre" name="nombre"></center>
                            <center>
                                <p class="label">Usuario</p>
                            </center>
                            <center><input class="inputfromadmin" placeholder="Usuario" name="usuario"></center>
                            <center>
                                <p class="label">Teléfono</p>
                            </center>
                            <center><input class="inputfromadmin" placeholder="Telefono" name="telefono"></center>
                            <center>
                                <p class="label">Contraseña</p>
                            </center>
                            <center><input class="inputfromadmin" placeholder="Contraseña" name="contrasena"></center>
                            <center><input type="submit" class="botonfromadmin" value="Aceptar">

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