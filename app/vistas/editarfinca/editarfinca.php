<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/finca.css' ?>">
    <link rel="stylesheet" type="text/css" href=" <?php echo RUTA_URL . 'public/css/crearfinca.css' ?>">
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
            <div class="contenedorFinca">
                <div class="finca">
                    <div class="finca1">
                        <h1>Fincas</h1>
                    </div>
                    <div class="finca2">
                        <div class="registrarFinca">
                            <div class="datosFinca">
                                <div class="tituloFinca">
                                    <center>
                                        <h1 class="titulocrearfinca">Editar Finca</h1></br>
                                    </center>

                                </div>
                                <div class="inputFinca">
                                    <form action="<?php echo RUTA_URL . 'florian/actualizarFinca' ?>" method="POST">

                                        <input type="hidden" name="id_finca" value="<?php echo $datos['id_finca'] ?>">
                                        <center><input class="ingresarDatos" placeholder="Nit Finca" name="nit" value="<?php echo $datos['nit'] ?>"></center></br>
                                        <center><input class="ingresarDatos" placeholder="Nombre Finca" name="nombre_finca" value="<?php echo $datos['nombre_finca'] ?>"></center></br>
                                        <center><input class="ingresarDatos" placeholder="Direccion Finca" name="direccion" value="<?php echo $datos['direccion'] ?>"></center></br>
                                        <P><?php if (!empty($datos['error']))
                                                echo $datos['error'];
                                            ?></p>
                                        <center><input type="submit" class="botonesinputfinca" value="Enviar">
                                            <button class="botonesinputfinca" onclick="window.location='../index/index.php'">Cancelar</button></center>
                                    </form>
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