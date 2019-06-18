<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/style2.css' ?>">
</head>

<body>
    <div class="posicion1admin">
        <img src="<?php echo RUTA_URL . 'public/img/bpa.png' ?>" class="logo">
    </div>
    <div class="posicion2admin">
        <h1 class="tituloUsuarioadmin">Buenas Prácticas Agrícolas</h1>
        <button class="cerraradmin" role="link" onclick="window.location='<?php echo RUTA_URL . 'enrutador/cerrarSesion' ?>'">Cerrar Sesión</button>
    </div>
</body>

</html> 