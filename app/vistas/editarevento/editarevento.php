<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/eventos.css' ?>">
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
            <div class="contenedorFincaeventos">
                <div class="eventos">
                    <div class="eventos1">
                        <h1 class="nombrefinca"><?php echo $datos['finca']; ?></h1>
                    </div>

                    <div class="datosEvento">
                        <div class="tituloevento">
                            <h1 class="nombrefinca">Editar Evento</h1>
                        </div>
                        <div class="eventos4">
                            <div class="inputEvento">
                                <form action="<?php echo RUTA_URL . 'florian/actualizarEvento' ?>" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $datos['id'] ?>">
                                    <center>
                                        <p class="label">Titulo</p>
                                    </center>
                                    <center><input class="ingresarDatoevento" name="titulo" placeholder="Titulo" value="<?php echo $datos['titulo'] ?>"></center>
                                    <center>
                                        <p class="label">Fecha</p>
                                    </center>
                                    <center><input class=" ingresarDatoevento" name="fecha" placeholder="Fecha" value="<?php echo $datos['fecha'] ?>"></center>
                                    <center>
                                        <p class="label">Descripción</p>
                                    </center>
                                    <center><textarea class=" ingresarDatoeventoD" name="descripcion" placeholder="Descripcion" value="<?php echo $datos['descripcion'] ?>"></textarea></center>
                                    <p><?php if (!empty($datos['error'])) {
                                            echo $datos['error'];
                                        } ?></p>
                                    <center><input type="submit" class=" botoninputevento" value="Actualizar">
                            </div>
                        </div>
                        <div class="evento3">
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

</h tm l>