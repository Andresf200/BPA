<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/cultivosFinca.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/cultivosCreados.css' ?>">

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

                    <div class="cultivos1a">
                        <div class="titulocultivos">
                            <h1 class="nombrefinca">Cultivos</h1>
                        </div>
                        <div class="crearCultivo">
                            <button class="botonMas" onclick="window.location='<?php echo RUTA_URL . 'crearcultivo/crearCultivo' ?>'">+</button>
                            <h2 class="textoagregarCultivo">Click en el "+" para agregar un Cultivo</h2>
                        </div>
                        <div class="cultivos2">
                            <?php $i = 0 ?>
                            <?php foreach ($datos['id_tipo_cultivo'] as $dato) : ?>
                                <div class="cultivocajas">
                                    <div class="Titulocajacultivo">
                                        <h2>
                                            <?php echo $dato->id_tipo_cultivo ?>
                                        </h2>
                                    </div>
                                    <div class="datoscultivocaja">
                                        <div class="datocultivo">
                                            <p>Área: <?php echo $dato->area ?></p>

                                        </div>
                                        <div>
                                            <p>Descripción: <?php echo $dato->descripcion ?></p>
                                        </div>
                                    </div>
                                    <div class="contenidocultivocaja">

                                        <button class="BotonCulti" onclick="window.location='<?php echo RUTA_URL . 'enrutador/editarCultivo/';
                                                                                                echo $dato->id; ?>'">Editar</button>
                                        <button name="eliminar" value="<?php echo $dato->id ?>" class="BotonCulti" id='eliminar<?php echo $i ?>' onclick='eliminar(<?php echo $i; ?>)'>
                                            <form action="<?php echo RUTA_URL . 'enrutador/eliminarCultivo/'; ?>" method="POST" id="myform<?php echo $i; ?>">
                                                Eliminar
                                            </form>
                                        </button>
                                    </div>
                                </div>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        </div>
                        <div class="cultivo3">
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
    <script type='text/javascript'>
        function eliminar(i) {

            if (confirm('Deseas eliminar el cultivo')) {
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