<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL . '../css/navegacion.css' ?>">


</head>

<body ng-app="BPAadmin" ng-controller="admin">
    <div class="contenedorBotonesadmin">
        <div class="botonesadmin">

            <button class="buttonadmin" onclick="window.location='<?php echo RUTA_URL . 'index2/admin' ?>'">Gestión de Usuarios</button>
        </div>
        <div class="botonesadmin">
            <button class="buttonadmin" onclick="window.location= '<?php echo RUTA_URL . 'gestionguiaadmin/mostrarGuiaAdmin' ?>'">Gestión de Guías</button>
        </div>
        <div class="botonesadmin">
            <button class="buttonadmin" onclick="window.location= '<?php echo RUTA_URL . 'tipsadmin/tipsadmin' ?>'">Tips</button>
        </div>
        <div class="botonesadmin">
            <button class="buttonadmin" onclick="window.location= '<?php echo RUTA_URL . 'formatoadmin/formatoadmin' ?>'">Formatos</button>
        </div>

    </div>
</body>

</html>