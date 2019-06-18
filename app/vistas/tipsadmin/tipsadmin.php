<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'css/style2.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'css/navegacionadmin.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'css/gestionadmin.css' ?>">
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
            <div class="contornogestionadmin">

                <div class="contornoopciones">
                    <!--<form enctype="multipart/form-data" action="<?php echo RUTA_URL . 'florian/agregarFormato' ?>" method="POST">
                        <input name="pdf" type="file" accept="aplication/pdf" required />
                        <input class="subirforma" type="submit" value="Subir archivo" />
                    </form>-->
                </div>

                <div class="contornodatos">
                    <div class="Tablaadmins">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Contenido</th>

                                    <th>Acciones</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $i = 0;
                                foreach ($datos['carrusel'] as $dato) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $dato->id  ?>
                                        </td>

                                        <td>
                                            <?php echo $dato->nombre ?>
                                        </td>
                                        <td>
                                            <?php echo $dato->contenido ?>
                                        </td>


                                        <td class="tdadmin"><a class="botoneeditadmin" onclick="window.location='<?php echo RUTA_URL . 'enrutador/Editartips/';
                                                                                                                    echo $dato->id; ?>'"><img src="<?php echo RUTA_URL . 'public/img/editar.png' ?>" class="iconeliminar"></a></td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach ?>
                            </tbody>
                        </table>
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