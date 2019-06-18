<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="  <?php echo RUTA_URL . 'public/css/style.css' ?>">

</head>

<body>
    <div class="posicion1">
        <img src="<?php echo RUTA_URL . 'public/img/bpa.png' ?>" class="logo">
    </div>
    <div class="posicion2">
        <h1 class="tituloUsuario">Buenas Prácticas Agrícolas</h1>
        <button class="cerrar" role="link" onclick="window.location='<?php echo RUTA_URL . 'cerrar/cerrarSesion' ?>'">Cerrar Sesión</button>
    </div>
</body>

</html> 