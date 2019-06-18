<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/finca.css' ?>">

</head>

<body>
    <div class="contenedor">
        <div class="superior">
            <?php
            //   include("../superior/superior.php");
            require(RUTA_APP . '/vistas/superior/superior.php');
            ?>
        </div>
        <div class="navegacion">
            <?php
            //     include("../navegacion/navegacion.php");
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
                        <div class="crearFinca">
                            <button class="botonMas" onclick="window.location='<?php echo RUTA_URL . 'crearfinca/crearFinca' ?>'">+</button>
                            <h2 class="textoFincaAgregar">Click en el "+" para agregar una finca</h2>
                        </div>


                        <div class="fincasregistradas">
                            <?php $i = 0 ?>
                            <?php foreach ($datos['nombre_finca'] as $dato) : ?>
                                <div class="fincacajas">
                                    <div class="Titulocajafinca">

                                        <h2>
                                            <?php echo $dato->nombre_finca ?>
                                        </h2>
                                    </div>
                                    <div class="contenidofincacaja">
                                        <div class="datosfincacaja">
                                            <p>Nit: <?php echo $dato->nit ?></p>
                                        </div>
                                        <div class="datosfincacaja">

                                            <p>Dirección: <?php echo $dato->direccion ?></p>
                                        </div>
                                    </div>
                                    <div class="contenidofincacaja">

                                        <button class="BotonCultivos" onclick="window.location='<?php echo RUTA_URL . 'enrutador/cultivoListar/';
                                                                                                echo $dato->id; ?>'">Cultivos</button>
                                        <button class="BotonC" onclick="window.location='<?php echo RUTA_URL . 'enrutador/eventoListar/';
                                                                                            echo $dato->id; ?>'">Evento</button>
                                        <button class="BotonC" onclick="window.location='<?php echo RUTA_URL . 'enrutador/editarFinca/';
                                                                                            echo $dato->id; ?>'">Editar</button>
                                        <button name="eliminar" value="<?php echo $dato->id ?>" class="BotonC" id='eliminar<?php echo $i ?>' onclick='eliminar(<?php echo $i; ?>)'>
                                            <form action="<?php echo RUTA_URL . 'enrutador/eliminarFinca/'; ?>" method="POST" id="myform<?php echo $i; ?>">
                                                Eliminar
                                            </form>
                                        </button>
                                    </div>
                                </div>
                                <?php $i++ ?>
                            <?php endforeach ?>
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

            if (confirm('Deseas eliminar la finca')) {
                var value = document.getElementById('eliminar' + i).value;
                var input = document.createElement('input');
                input.type = "text";
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