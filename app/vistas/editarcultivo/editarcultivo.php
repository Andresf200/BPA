<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href=" <?php echo RUTA_URL . 'public/css/cultivosFinca.css' ?>">
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
            <div class="contenedorFincacultivos">
                <div class="cultivos">

                    <div class="cultivos1">
                        <h1 class="nombrefinca">
                            <?php echo $datos['finca']; ?>
                        </h1>
                    </div>

                    <div class="datosCultivo">
                        <div class="titulocultivos">
                            <h1 class="nombrefinca">Editar Cultivo</h1>
                        </div>
                        <div class="cultivos4">
                            <div class="inputCultivo">
                                <form action="<?php echo RUTA_URL . 'florian/actualizarCultivo' ?>" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $datos['id'] ?>">
                                    <center>
                                        <p class="label">Tipo de Cultivo</p>
                                    </center>
                                    <center><input class="ingresarDatocultivo" name="id_tipo_cultivo" placeholder="Tipo de Cultivo" value="<?php echo $datos['id_tipo_cultivo'] ?>"></center>
                                    <center>
                                        <p class="label">Área M2</p>
                                    </center>
                                    <center><input class="ingresarDatocultivo" name="area" placeholder="Area en m2" value="<?php echo $datos['area'] ?>"></center>
                                    <center>
                                        <p class="label">Descripción</p>
                                    </center>
                                    <center><textarea class="ingresarDatocultivoD" name="descripcion" placeholder="Descripción" value="<?php echo $datos['descripcion'] ?>"></textarea></center>

                                    <p><?php if (!empty($datos['error'])) {
                                            echo $datos['error'];
                                        } ?></p>
                                    <center><input type="submit" class="volvercultivo" value="Aceptar">
                                </form>

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