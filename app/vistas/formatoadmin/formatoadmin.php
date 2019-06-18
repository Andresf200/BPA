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
                    <form enctype="multipart/form-data" action="<?php echo RUTA_URL . 'florian/agregarFormato' ?>" method="POST">
                        <input name="pdf" type="file" accept="aplication/pdf" required />
                        <input class="subirforma" type="submit" value="Subir archivo" />
                    </form>
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
                                $e = 0;
                                foreach ($datos['formato'] as $dato) : ?> <tr>
                                        <td>
                                            <?php echo $dato->id_formatos ?>
                                        </td>
                                        <td>
                                            <?php echo $dato->nombre_formatos ?>
                                        </td>
                                        <td>
                                            <?php echo $dato->url_formatos ?>
                                        </td>

                                        <td class="tdadminforma"><button name="eliminar" value="<?php echo $dato->id_formatos ?>" class="BotonC" id='eliminar<?php echo $e ?>' onclick='eliminarfor(<?php echo $e; ?>)'>
                                                <form action="<?php echo RUTA_URL . 'enrutador/formatoEliminar/'; ?>" method="POST" id="myform<?php echo $e; ?>"><img src="<?php echo RUTA_URL . 'public/img/eliminar.png' ?>" class="iconeliminar">

                                                </form>
                                            </button></td>
                                    </tr>
                                    <?php
                                    $e++;
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
    <script type='text/javascript'>
        function eliminarfor(e)

        {
            if (confirm('Deseas eliminar el formato')) {
                var value = document.getElementById('eliminar' + e).value;
                var input = document.createElement('input');
                input.type = "hidden";
                input.name = "valor";
                input.value = value;
                var form = 'myform' + e;
                document.getElementById(form).appendChild(input);

                document.getElementById('myform' + e).submit();
            }
        }
    </script>
</body>

</html>