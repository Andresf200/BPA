<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/eventos.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/eventosCreados.css' ?>">

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

                    <div class="eventos1a">
                        <div class="tituloevento">
                            <h1 class="nombrefinca">Eventos</h1>
                        </div>

                        <div class="crearEvento">
                            <button class="botonMas" onclick="window.location='<?php echo RUTA_URL . 'crearevento/crearEvento' ?>'">+</button>
                            <h2 class="textoagregarEvento">Click en el "+" para agregar un Evento</h2>
                        </div>

                        <div class="eventos2">
                            <?php $i = 0 ?>
                            <?php foreach ($datos['titulo'] as $dato) : ?>
                                <div class="eventocajas">
                                    <div class="Titulocajaevento">
                                        <h2>
                                            <?php echo $dato->titulo ?>
                                        </h2>
                                    </div>
                                    <div class="datoseventocaja">
                                        <div class="datoevento">
                                            <p>Fecha: <?php echo $dato->fecha ?></p>
                                        </div>
                                        <div class="datoevento">
                                            <p>Descripción: <?php echo $dato->descripcion ?></p>
                                        </div>
                                    </div>
                                    <div class="contenidoeventocaja">
                                        <button class="BotonEvento" onclick="window.location='<?php echo RUTA_URL . 'enrutador/editarEvento/';
                                                                                                echo $dato->id; ?>'">Editar</button>
                                        <button name="eliminar" value="<?php echo $dato->id ?>" class="BotonEvento" id='eliminar<?php echo $i ?>' onclick='eliminar(<?php echo $i; ?>)'>
                                            <form action="<?php echo RUTA_URL . 'enrutador/eliminarEvento/'; ?>" method="POST" id="myform<?php echo $i; ?>">
                                                Eliminar
                                            </form>
                                        </button>
                                    </div>
                                </div>
                                <?php $i++ ?>
                            <?php endforeach ?>
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
    <script type='text/javascript'>
        function eliminar(i) {

            if (confirm('Deseas eliminar el evento')) {
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