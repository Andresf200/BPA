<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . 'public/css/navegacion.css' ?>">  

</head>
<body>
    <div class="contenedorBotones">
        <div class="botones">
            <button class="button" role="link" onclick="window.location='<?php echo RUTA_URL . 'index/mostrarfincas' ?>'">Fincas</button>
        </div>
        <div class="botones">
            <button class="button" role="link" onclick="window.location='<?php echo RUTA_URL . 'mantenimiento/mostrarGuias' ?>'">Guías</button>
        </div>
       
        <div class="botones">
            <button class="button" onclick="window.location='<?php echo RUTA_URL . 'formatos/mostrarFormatos' ?>'">Formatos</button>
        </div>
    </div>
</body>
</html>