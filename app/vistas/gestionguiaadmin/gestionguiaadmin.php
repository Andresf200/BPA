<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style2.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/navegacionadmin.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/gestionguias.css' ?>">
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
            <div class="contornogestionguias">

                <div class="contornoopcionesguias">

                </div>

                <div class="contornodatosguias">
                    <div class="Tablaaguias">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titulo</th>
                                    <th>Tipo</th>
                                    <th>Contenido</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($datos['id'] as $dato) : ?>
                                    <tr>
                                        <td><?php echo $dato->id ?></td>
                                        <td><?php echo $dato->titulo ?></td>
                                        <td><?php echo $dato->tipo ?></td>
                                        <td width="70%"><?php echo $dato->contenido ?></td>
                                        <td width="10%" class="tdguias"><a class="botoneeditguias" onclick="window.location='<?php echo RUTA_URL . 'enrutador/editarguiaadmin/';
                                                                                                                                echo $dato->id; ?>'"><img src="<?php echo RUTA_URL . 'public/img/editar.png' ?>" class="iconeliminar"></a></td>
                                    </tr>

                                <?php endforeach ?>

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
        function eliminar(i) {

            if (confirm('Deseas eliminar la guia')) {
                var value = document.getElementById('eliminar' + i).value;
                var input = document.createElement('input');
                input.type = "hidden";
                input.name = "valor";
                input.value = value;
                var form = 'myform' + i;
                document.getElementById(form).appendChild(input);

                document.getElementById('myform' + i).submit();
            }
        }
    </script>
</body>

</html>