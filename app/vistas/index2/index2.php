<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style2.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/navegacionadmin.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/gestionadmin.css' ?>">
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
                    <button class="botonMas" class="botonagregarFinca" onclick="window.location= '<?php echo RUTA_URL . 'crearusuarioadmin/crearusuarioadmin' ?>'">+</button>
                    <h2 class="textoFincaAgregar">Click en el "+" para agregar un administrador</h2>
                </div>

                <div class="contornodatos">
                    <div class="Tablaadmins">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Usuario</th>
                                    <th>Contraseña</th>
                                    <th>Id Rol</th>
                                    <th colspan="2">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                <?php foreach ($datos['usuario'] as $dato) : ?>
                                    <tr>

                                        <td>
                                            <?php echo $dato->nombre ?>
                                        </td>
                                        <td>
                                            <?php echo $dato->telefono ?>
                                        </td>
                                        <td>
                                            <?php echo $dato->usuario ?>
                                        </td>
                                        <td>
                                            <?php echo $dato->contrasena ?>
                                        </td>
                                        <td>
                                            <?php echo $dato->id_rol ?>
                                        </td>
                                        <td class="tdadmin"><a class="botoneeditadmin" onclick="window.location='<?php echo RUTA_URL . 'enrutador/editarUsuarioAdmin/';
                                                                                                                    echo $dato->id; ?>'"><img src="<?php echo RUTA_URL . 'public/img/editar.png' ?>" class="iconeliminar"></a></td>
                                        <td class="tdadmin">
                                            <button name="eliminar" value="<?php echo $dato->id ?>" class="BotonC" id='eliminar<?php echo $i ?>' onclick='eliminar(<?php echo $i; ?>)'>
                                                <form action="<?php echo RUTA_URL . 'enrutador/eliminarAdmin/'; ?>" method="POST" id="myform<?php echo $i; ?>" <img src="<?php echo RUTA_URL . 'public/img/eliminar.png' ?>" class="iconeliminar">
                                                    Eliminar
                                                </form>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
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