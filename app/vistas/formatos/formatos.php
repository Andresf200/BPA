<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/formatos.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/contenidoFormatos.css' ?>">
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
            <div class="formatos">
                <div class="formatos1">
                    <h1>Formatos</h1>
                </div>
                <div class="formatos2">
                    <div class="contenenidoFormatos">
                        <!--------Cada caja para cada formtato--------->
                        <?php $longitud = count($datos);
                       
                        ?>
                        <?php for ($i = 0; $i < $longitud; $i++) : ?>
                            <div class="formatoscajas">
                                <div class="contenidoformatocaja">
                                    <embed src="<?php echo RUTA_URL . '/formatos/' . $datos[$i] ?>" type="application/pdf" width="95%"></embed>
                                </div>
                            </div>
                        <?php endfor ?>
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