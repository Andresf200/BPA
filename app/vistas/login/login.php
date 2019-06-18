<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="<?php echo RUTA_URL . 'public/img/icon.png' ?>" class="logo" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL . 'public/css/style_login.css' ?>  ">
    <link rel="stylesheet" href="<?php echo RUTA_URL . 'public/css/fontello-embedded.css' ?>">
    <link rel="stylesheet" href="<?php echo RUTA_URL . 'public/css/style-carrusel.css' ?>  ">
    <link rel="stylesheet" href="<?php echo RUTA_URL . 'public/css/style-terminos.css' ?> ">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaijaan" rel="stylesheet">
    <title>BPA</title>

</head>

<body>
    <div class="contenedor-global">
        <header>
            <div class="icon">
                <img src="<?php echo RUTA_URL . 'public/img/bpa.png' ?>" class="logo">
            </div>
            <div class="login">
                <span class="icon-user-o"></span>

                <form action="login/validarLogin" method="POST">
                    <input type="text" placeholder="Usuario" name="usuario" class="usuario">
                    <input type="password" placeholder="Contraseña" name="clave" class="usuario">
                    <input type="submit" value="Ingresar" class="ingresar">

                </form>
            </div>
        </header>
        <div class="carrusel">
            <aside class="container">
                <div id="carousel" style="transform: translateZ(-200px) rotateY(-360deg);">

                    <?php
                    foreach ($datos['id_carrusel'] as $dato) : ?>
                        <p><?php echo $dato->contenido ?></p>
                    <?php endforeach ?>
                </div>
            </aside>
        </div>
        <section>
            <div class="registro">
                <center>
                    <form action="<?php echo RUTA_URL . 'florian/agregarUsuario' ?>" class="form" method="POST">
                        <h2>Registrate</h2>
                        <input type="text" placeholder="Nombre" class="campos" name="nombre" required="">
                        <input type="number" placeholder="Télefono" class="campos" name="telefono" required="">
                        <input type="text" placeholder="Usuario" class="campos" name="usuario" required="">
                        <input type="password" placeholder="Contraseña" class="campos" name="contrasena" required="">
                        <input type="password" placeholder="Confirmar contraseña" class="campos" name="confcontrasena" required="">
                        <div class="terminos">
                            <input type="checkbox" name="terminos" required="">
                            <p>Acepto <a href="#openModal">términos y condiciones</p></a>
                        </div>
                        <input type="submit" class="registrarse" value="Registrarse">
                    </form>
                </center>
                <div>
            
                        <?php if(!empty($_GET['b'])){
                                echo $_GET['b'];
                        }  
                        ?>
                   
                </div>
            </div>
        </section>
        <div id="openModal" class="modalDialog">
            <div class="flex">
                <a href="#close" title="Cerrar" class="close">X</a>
                <div class="infor">
                    <h3 class="titulo">Términos y condiciones BPA</h3>
                    <p class="parrafo">
                        Reglamento de uso para el manejo de la aplicación
                        El siguiente documento establece las condiciones mediante las cuales se regirá el uso del software Buenas Practicas Agropecuarias (en adelante el software), la cual va ser operada por el equipo de desarrolladores del Sena centro de tecnologías agroindustriales, dicha institución se encuentra en Colombia y su domicilio en la ciudad de Cartago valle del cauca.
                        La aplicación funcionara como un canal para la realización de ciertas actividades descritas más adelante con el objetivo de facilitar el acceso a los especialistas de las Buenas Practicas Agropecuarias.
                        El usuario se compromete a leer los términos y condiciones aquí establecidas, previamente a la instalación del software, por tanto, en caso de realizar la instalación se entiende que cuenta con el conocimiento integral de este documento y la consecuente aceptación de la totalidad de sus estipulaciones.
                        El usuario reconoce que el ingreso de su información personal, y los datos que contiene el software a su disposición respecto a los archivos subidos, la realicen de manera voluntaria, quienes optan por acceder a esta aplicación son responsables del cumplimiento de las leyes, en la medida que dichas leyes sean aplicables en su correspondiente país. En caso de que se acceda por parte de menores sin ningún conocimiento del software o de personas mal intencionadas que puedan afectar el funcionamiento del mismo, debe de mantener en constante monitoreo y muy atento de la persona que sin su consentimiento está haciendo uso del software, ya que si usted como usuario permite que un menor de edad o una persona maliciosa maneje esta aplicación. No tendremos ninguna responsabilidad si dichas personas llegan afectar el correcto funcionamiento o afecte directamente la configuración y los archivos que estén alojados en el software.
                        Requisitos para el uso de este software
                        El usuario deberá contar con un ordenador o un dispositivo con sistemas operativos; En el caso de que sea desde los ordenadores deberá contar con (Windows, Linux o Mac OS). En el caso de que sea un Smartphone deberá contar con (Android o IOS), estos deberán tener una conexión estable a internet (Tenga en cuenta que ya que el software va estar basado en transferencia de información a través de la nube la velocidad en la que se transfieran los archivos y la estabilidad del mismo va depender de la conexión que tenga a internet), no nos haremos responsables si su dispositivo ha sido afectado con algún tipo de virus o si su conexión a internet tiene alguna irregularidad antes de adquirir el software asegúrese que los dispositivos que va a emplear tienen los últimos parches de seguridad instalados y que no vaya a correr algún riesgo. (Se realizaran copias de seguridad para evitar pérdidas de información).
                        Para adquirir la aplicación su equipo deberá tener las siguientes características (Le recordamos que el desempeño de la aplicación dependerá del hardware que tenga su dispositivo ya sea un ordenador o un dispositivo inteligente).
                        Características para su funcionamiento (Ordenador Smartphone):
                        • El procesador deberá tener una velocidad de reloj básica de 2,0GHZ en adelante y deberá de contar como mínimo con dos núcleos (Recuerde que entre más núcleos y más velocidad de reloj tenga el procesador podrá procesar de manera más eficiente los procesos).
                        • Debe de contar con memoria RAM de mínimo 4GB y a una frecuencia de reloj de minino 1333MHz.
                        • Se requiere de un navegador.
                        • Se requiere de una conexión a internet de 5MG en adelante (recuerde que entre más velocidad y ancho de banda tenga su conexiona internet el software tendrá un mejor desempeño).

                        Para acceder al software el usuario deberá ingresar con usuario y contraseña que lo identificara con un rol que previamente se le asignara al momento de adquirir nuestro software (Si por alguna razón se ha olvidado de su usuario o su contraseña, se debe comunicarnos inmediatamente para restablecer su usuario o su contraseña).
                        Obligaciones de los usuarios
                        El usuario se obliga a usar el software y los contenidos encontrados en ella de una manera diligente, correcta, licita y en especial, se comprométete a NO realizar las conductas a continuación
                        (a) Utilizar los contenidos de forma, con fines o efectos contrarios a la ley, a la moral y a las buenas costumbres generalmente aceptadas o al orden público;
                        (b) a no reproducir, copiar, representar, utilizar, hurtar, destruir, transformar o modificar contenidos del software, por cualquier procedimiento o cualquier soporte, total o parcial.
                        (c) a no utilizar el contenido de tal manera que sea un peligro para el funcionamiento del software.
                        (d) Suprimir, eludir o manipular el derecho de autor y demás datos identificados de los derechos de autor incorporados a los contenidos, así como los dispositivos técnicos de protección, o cualquier mecanismo de información que pudiesen tener los contenidos
                        (e) NO permitir que terceros hagan uso del software sin su consentimiento.
                        (f) A suministrarnos información real en el momento en el que se le esté creando el perfil.
                        (g) Utilizar el software con fines ilícitos y o lícitos.
                        (h) A no proporcionar información errónea o falsa de su profesión o del rol que se le va a otorgar.
                        (i) Permitir que se realice una investigación profunda por si se detecta que hay contenidos sospechosos en la transferencia de archivos.
                        Propiedad intelectual
                        Todo material informático, grafico, publicitario, fotográfico, de multimedia, audiovisual y de diseño, así como todos los contenidos, texto y bases de datos puestos a su disposición en este software están protegidos por derechos de autor y/o propiedad industrial cuyo titular es el equipo de desarrolladores del centro de tecnología agroindustrial. Todos los contenidos en la aplicación están protegidos por las normas sobre derecho de autor y por todas las normas nacionales e internacionales.
                        En ningún caso estos Términos y condiciones confieren derechos, licencias ni autorizaciones para realizar los actos anteriormente prohibidos. Cualquier uso no autorizado de los contenidos constituirá una violación del presente documento y a las normas vigentes sobre derecho de autor, a las normas vigentes nacionales e internacionales sobre propiedad intelectual, y a cualquier otra que sea aplicable.
                        Uso de información y privacidad
                        Con la instalación y la creación del perfil en el software usted acepta que se utilicen sus datos en calidad de responsable del tratamiento para fines derivados de la ejecución del software, también se va prescindir a los derechos de conocer, actualizar, rectificar y suprimir su información personal y profesional para evitar que terceros hagan uso de dicha información de manera mal intencionada y se puedan evitar posibles robos y posibles estafas, se le garantiza al usuario que su información suministrada y compartida por ningún motivo va ser usada de forma ilícita y mal intencionada.

                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>