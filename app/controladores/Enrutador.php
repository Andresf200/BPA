<?php
//este archivo es el centro el encargado de recibir los datos de la vista y pasarlos a los modelos y retonar esos datos a las vistas siguientes 
class Enrutador extends Controlador
{
  //esta es la funcion _construct encargada de estanciar cada uno de los modelos
  public function __construct()
  {
    $this->sesionModelo     =   $this->modelo('Sesion');
    $this->usuarioModelo    =   $this->modelo('Usuario');
    $this->fincaModelo      =   $this->modelo('Finca');
    $this->cultivoModelo    =   $this->modelo('Cultivo');
    $this->guiasModelo      =   $this->modelo('Guias');
    $this->registrarModelo  =   $this->modelo('Registrar');
    $this->eventoModelo     =   $this->modelo('Evento');
    $this->formatoModelo    =   $this->modelo('Formatos');
    $this->carruselModelo   =   $this->modelo('Carrusel');
    $this->validarModelo    =   $this->modelo('Validar');
    $this->modeloEliminar   =   $this->modelo('Eliminar');
    $this->modeloEncriptar =    $this->modelo( 'Encriptacion');
  }
  //esa es la funcion encargada de mostrar la vista login y gestionar la impresion del contenido de el carrousel
  public function index()
  {

    $carrusel = $this->carruselModelo->listarCarrusel();
    array_push($carrusel, "");
    $datos = [
      "id_carrusel"       => $carrusel,

    ];

    $this->vista("login/login", $datos);
  }
  public function validarSesion()
  {
    $user = $this->sesionModelo->getCurrentUser();
    if (isset($user)) {
      //echo "Bienvenido";
    } else {
      header('Location:' . RUTA_URL);
    }
  }
  //esta es la funcion encargada de validar el login con la base de datos donde enviamos al modelo esperando respuesta 
  //para darle el permiso de seguir en la ejecucion del sistema
  public function validarLogin()
  {
    if (isset($_SESSION['user'])) {
      $this->vista("index/index");
    } else if (isset($_POST['usuario']) && isset($_POST['clave'])) {
      $userForm = $this->usuarioModelo->limpiarDatos($_POST['usuario']);
      $passForm = $this->usuarioModelo->limpiarDatos($_POST['clave']);
        $pass   = $this->usuarioModelo->usuarioExiste($userForm);
        if ($this->modeloEncriptar->validar($passForm , $pass)) {
        $IdUser = $this->usuarioModelo->retornoID($userForm);
        $userSession = $this->sesionModelo->setCurrentUser($IdUser[0]->id); //Asigno el usuario a mi SESSIO
        $userID = $this->sesionModelo->getCurrentUser($userSession);
        $rol = $this->usuarioModelo->retornarPermiso($userID);
        if ($rol[0]->id_rol == "2") {
          $usuario = $this->usuarioModelo->listarUsuario();
          $datos = [
            'nombre' => $usuario,
            'telefono' => $usuario,
            'usuario' => $usuario,
            'contrasena' => $usuario,
            'id_rol' => $usuario,
          ];
          $this->vista("index2/index2", $datos);
         } else {
         
          $fincas = $this->fincaModelo->listarFinca($userID);
          $datos = [
            "id" => $fincas,
            "nombre_finca" => $fincas
          ];
          $this->vista("index/index", $datos);
        }
      } else {
        $errorLogin = 'Nombre de usuario y/o password es incorrecto';
        $datos = [
          'usuarios' => $errorLogin
        ];
        echo "<script>
                alert('las contraseñas no conciden');
                window.location= 'login.php'
              </script>";
        header('Location:' . RUTA_URL);
      }
    } else {
      header('Location:' . RUTA_URL); //Aqui redirijo porque no existe la session
    }
  }
  //esta es la funcion encargada de agregar el usuario validar los campos vacios
  public function agregarUsuario()
  {
    if (
      !empty($_POST['nombre'])
      && !empty($_POST['telefono'])
      && !empty($_POST['usuario'])
      && !empty($_POST['contrasena'])
      && !empty($_POST['confcontrasena'])
      && !empty($_POST['terminos'])
    ) {
      switch ($_POST['nombre']
        && $_POST['telefono']
        && $_POST['usuario']
        && $_POST['contrasena']
        && $_POST['confcontrasena']
        && $_POST['terminos']) {
        case 'string':
          if ($_POST['terminos'] = "on ") {
            if ($_POST['contrasena'] =  $_POST['confcontrasena']) {
              if ($this->validarModelo->ValidarIngresar($_POST['telefono'])) {
                $contrasena = $this->modeloEncriptar->encrytando($_POST['contrasena']);
                $datos = [
                  'nombre' => filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING),
                  'telefono' => filter_var(trim($this->validarModelo->ValidarIngresar($_POST['telefono'])), FILTER_SANITIZE_NUMBER_INT),
                  'usuario' => filter_var(trim($_POST['usuario']), FILTER_SANITIZE_STRING),
                  'contrasena' => filter_var(trim($contrasena), FILTER_SANITIZE_STRING),
                  'terminos' => filter_var(trim($_POST['terminos'])),
                  'id_rol' => 1
                ];
                
                if ( $this->usuarioModelo->agregarUsuario($datos)) {
                  header('Location:' . RUTA_URL . "?b=usuario registrado");
                } else {

                  header('Location:' . RUTA_URL . "?b=usuario no registrado");
                }
              } else {
                header('Location:' . RUTA_URL . "?b=error el telefono no es valido");
              }
            } else {
              header('Location:' . RUTA_URL . "?b=las contraseñas no conciden");
            }
          } else {
            header('Location:' . RUTA_URL . "?b=debe aceptar los terminos y condiciones");
          }
          break;

        default:
          header('Location:' . RUTA_URL . "?b=revise que todos los campos estan correctos");
          break;
      }
    } else {

      header('Location:' . RUTA_URL . "?b=revise que todos los campos estan correctos");
    }
  }
  //esta es la funcion encargada de cerrar la cesion y borrar la memoria cache
  public function cerrarSesion()
  {
    $this->sesionModelo->closeSession();
    header('Location:' . RUTA_URL); //Aqui redirijo porque no existe la session
  }
  /*esta es la funcion encarga de imprmir las fincas en la vista principal donde pedimos los datos al modelo */
  public function mostrarFincas()
  {
    $this->validarSesion();
    $userID = $this->sesionModelo->getCurrentUser();
    $fincas = $this->fincaModelo->listarFinca($userID);
    $datos = [
      "id" => $fincas,
      "nombre_finca" => $fincas
    ];
    $this->vista("index/index", $datos);
  }
  /*esta es la funcion encarga de imprmir las guias en la vista principal donde pedimos los datos al modelo */
  public function mostrarGuias()
  {
    $this->validarSesion();
    $id = 1;
    $mantenimiento = $this->guiasModelo->listarGuias($id);
    $datos = [
      'contenido' => $mantenimiento[0]->contenido
    ];
    $this->vista("mantenimiento/mantenimiento", $datos);
  }
  /*esta es la funcion encarga de imprmir los formatos en la vista principal donde pedimos los datos al modelo */
  public function mostrarFormatos()
  {
    $this->validarSesion();
    $directory = RUTA_PUBLIC . '/formatos/';
    $dirint = dir($directory);
    while (($archivo = $dirint->read()) !== false) {
      if (preg_match("/pdf/i", $archivo)) {

        $datos[] = $archivo;
      }
    }

    $dirint->close();

    $this->vista("formatos/formatos", $datos);
  }
  /*esta es la funcion encarga de imprmir la guia especifica de mantenimiento en la vista principal donde pedimos los datos al modelo */
  public function guiasMantenimiento()
  {
    $this->validarSesion();
    $id = 1;
    $mantenimiento = $this->guiasModelo->listarGuias($id);
    $datos = [
      'contenido' => $mantenimiento[0]->contenido
    ];
    $this->vista("mantenimiento/mantenimiento", $datos);
  }
  /*esta es la funcion encarga de imprmir la guia especifica de cultivos en la vista principal donde pedimos los datos al modelo */
  public function guiasCultivos()
  {
    $this->validarSesion();
    $id = 2;
    $mantenimiento = $this->guiasModelo->listarGuias($id);
    $datos = [
      'contenido' => $mantenimiento[0]->contenido
    ];
    $this->vista("guiacultivos/guiacultivos", $datos);
  }
  /*esta es la funcion encarga de imprmir la guia especifica de ecologia en la vista principal donde pedimos los datos al modelo */
  public function guiasEco()
  {
    $this->validarSesion();
    $id = 3;
    $mantenimiento = $this->guiasModelo->listarGuias($id);
    $datos = [
      'contenido' => $mantenimiento[0]->contenido
    ];
    $this->vista("eco/eco", $datos);
  } /*esta es la funcion encarga de imprmir la guia especifica de documentacion en la vista principal donde pedimos los datos al modelo */
  public function guiasDocumentacion()
  {
    $this->validarSesion();
    $id = 4;
    $mantenimiento = $this->guiasModelo->listarGuias($id);
    $datos = [
      'contenido' => $mantenimiento[0]->contenido
    ];
    $this->vista("documentacion/documentacion", $datos);
  }
  /*esta es la funcion encargada de mostar la vista crear finca */
  public function crearFinca()
  {
    $this->validarSesion();
    $this->vista("crearfinca/crearfinca");
  }
  /*esta es la funcion encargada de hacer un insert de la finca que el usuario necesita para la base de datos */
  public function agregarFinca()
  {
    $this->validarSesion();
    
    if (
      !empty($_POST['nit'])
      && !empty($_POST['nombre_finca'])
      && !empty($_POST['direccion'])
    ) {
      switch ($_POST['nit']
        && $_POST['nombre_finca']
        && $_POST['direccion']) {
        case 'string':
          if ($this->validarModelo->ValidarIngresar($_POST['nit'])) {
            $userID =  $this->sesionModelo->getCurrentUser();
            
            $datos = [
              'id_usuario'   => $userID,
              'nit' => filter_var(trim($this->validarModelo->ValidarEntero($_POST['nit'])), FILTER_SANITIZE_NUMBER_INT),
              'nombre_finca' => filter_var(trim($_POST['nombre_finca']), FILTER_SANITIZE_STRING),
              'direccion'  => filter_var(trim($_POST['direccion']), FILTER_SANITIZE_STRING)
            ];
      
            if ($this->fincaModelo->insertarFinca($datos)) {
              echo "<script type='text/javascript'>
                alert('finca creada con exito');
              </script>";
              $this->mostrarFincas();
            }
          } else {
            //error de nit 
            $datos = "error el nit no es un entero valido";
            $this->vista('crearfinca/crearfinca', $datos);
          }
          break;
        default:
          $datos = [
            'nit'          => '',
            'nombre_finca' => '',
            'direccion' => ''
          ];
          header('Location:' . RUTA_URL . 'crearfinca/crearFinca');
          break;
      }
    }else{
      //error de nit 
      $datos = "error campos vacios";
      $this->vista('crearfinca/crearfinca', $datos);
    }
  }
  /*esta es la funcion encargada de mostar la vista editar la finca donde imprimin los datos actualez de la fiunca que desea cambiar*/
  public function editarFinca($id)
  {
    $this->validarSesion();
    $finca = $this->fincaModelo->retornarFinca($id);
    $datos = [
      'id_finca'     => $id,
      'nit'          => $finca[0]->nit,
      'nombre_finca' => $finca[0]->nombre_finca,
      'direccion'    => $finca[0]->direccion
    ];
    $this->vista("editarfinca/editarfinca", $datos);
  }
  /*esta es la funcion encargada de actualzizar las fincas haciendo una conexion con su modelo especifico */
  public function actualizarFinca()
  {
    $this->validarSesion();
    if (
      !empty($_POST['id_finca'])
      && !empty($_POST['nit'])
      && !empty($_POST['nombre_finca'])
      && !empty($_POST['direccion'])
    ) {
      switch ($_POST['id_finca']
        && $_POST['nit']
        && $_POST['nombre_finca']
        && $_POST['direccion']) {
        case 'string':
        
          if ($this->validarModelo->ValidarIngresar($_POST['nit'])) {
            $datos = [
              'id' => filter_var(trim($this->validarModelo->ValidarEntero($_POST['id_finca'])), FILTER_SANITIZE_NUMBER_INT),
              'nit' => filter_var(trim($this->validarModelo->ValidarEntero($_POST['nit'])), FILTER_SANITIZE_NUMBER_INT),
              'nombre_finca' => filter_var(trim($_POST['nombre_finca']), FILTER_SANITIZE_STRING),
              'direccion'  => filter_var(trim($_POST['direccion']), FILTER_SANITIZE_STRING)
            ];
                
            if ($this->fincaModelo->actualizarFinca($datos)) {
              echo "<script type='text/javascript'>
                alert('finca  con exito');
              </script>";
              $this->mostrarFincas();
              
            }else{
              $finca = $this->fincaModelo->retornarFinca($_POST['id_finca']);
              array_push($finca, "error los datos son iguales");
              $datos = [
                'id_finca'     => $_POST['id_finca'],
                'nit'          => $finca[0]->nit,
                'nombre_finca' => $finca[0]->nombre_finca,
                'direccion'    => $finca[0]->direccion,
                'error'        => $finca[1]
              ];
              $this->vista("editarfinca/editarfinca", $datos);  
            }
          } else {
            //error de nit 
            $finca = $this->fincaModelo->retornarFinca($_POST['id_finca']);
            array_push($finca, "error el nit no es un entero valido");
            $datos = [
              'id_finca'     => $_POST['id_finca'],
              'nit'          => $finca[0]->nit,
              'nombre_finca' => $finca[0]->nombre_finca,
              'direccion'    => $finca[0]->direccion,
              'error'        => $finca[1]
            ];
            $this->vista("editarfinca/editarfinca", $datos);
          }
          break;
        default:
          $finca = $this->fincaModelo->retornarFinca($_POST['id_finca']);
          array_push($finca, "error al editar la finca");
          $datos = [
            'id_finca'     => $_POST['id_finca'],
            'nit'          => $finca[0]->nit,
            'nombre_finca' => $finca[0]->nombre_finca,
            'direccion'    => $finca[0]->direccion,
            'error'        => $finca[1]
          ];
          $this->vista("editarfinca/editarfinca", $datos);

          break;
      }
    } else {
      $finca = $this->fincaModelo->retornarFinca($_POST['id_finca']);
      array_push($finca, "error campos vacios");
      $datos = [
        'id_finca'     => $_POST['id_finca'],
        'nit'          => $finca[0]->nit,
        'nombre_finca' => $finca[0]->nombre_finca,
        'direccion'    => $finca[0]->direccion,
        'error'        => $finca[1]
      ];
      $this->vista("editarfinca/editarfinca", $datos);
    }
  }
  /*esta es la funcion encargada de hacer un eliminado logico a las fincas*/
  public function eliminarFinca()
  {
    $this->validarSesion();
    $id = $_POST['valor'];
    $id = $this->validarModelo->ValidarEntero($id);
    $this->fincaModelo->eliminarFinca($id);
    header('Location:' . RUTA_URL . 'index/mostrarFincas');
  }
  /*esta es la funcion encargada de imprimir todos los cultivos que el usuario tiene disponibles en la base de datos */
  public function cultivoListar($id)
  {
    $this->validarSesion();
    $id = $this->validarModelo->ValidarEntero($id);
    $_SESSION['id_finca'] = $id;
    $finca  = $this->fincaModelo->mostrarFinca($id);
    $cultivo = $this->cultivoModelo->listarCultivos($id);
    $datos = [
      'finca' => $finca[0]->nombre_finca,
      'id' => $cultivo,
      'id_tipo_cultivo' => $cultivo,
    ];


    $this->vista("cultivo/cultivo", $datos);
  }
  /*esta es la funcion encargada de mostar la vista crear cultivo  */
  public function crearCultivo()
  {
    $this->validarSesion();
    $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
    $datos = [
      'finca' => $finca[0]->nombre_finca,
    ];
    $this->vista("crearcultivo/crearcultivo", $datos);
  }
  /*esta es la funcion encargada de hacer un insert de los cultivos que el usuario necesita para la base de datos */
  public function agregarCultivo()
  {
    $this->validarSesion();

    if (
      !empty($_POST['tipo'])
      && !empty($_POST['area'])
      && !empty($_POST['descripcion'])
    ) {
      switch ($_POST['tipo']
        && $_POST['area']
        && $_POST['descripcion']) {
        case 'string':
          if ($this->validarModelo->ValidarInFloat($_POST['area'])) {
            $datos = [
              'id_finca' => $_SESSION['id_finca'],
              'id_tipo_cultivo' => filter_var(trim($_POST['tipo']), FILTER_SANITIZE_STRING),
              'area' => filter_var(trim($this->validarModelo->ValidarFloat($_POST['area'])), FILTER_SANITIZE_NUMBER_FLOAT),
              'descripcion' => filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_STRING)
            ];
            if ($this->cultivoModelo->insertarCultivo($datos)) {
              echo "<script type='text/javascript'>
                alert('cultivo creado con exito');
              </script>";
              $this->mostrarFincas();
            } else {
              $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
              $datos = [
                'finca' => $finca[0]->nombre_finca,
                'error' => "hubo un error en el cultivo no pudo ser creado"
              ];
              $this->vista('crearcultivo/crearcultivo', $datos);
            }
          } else {
            $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
            $datos = [
              'finca' => $finca[0]->nombre_finca,
              'error' => "el numero ingresado no es valido"
            ];
            $this->vista('crearcultivo/crearcultivo', $datos);
          }
          break;
        default:
          $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
          $datos = [
            'finca' => $finca[0]->nombre_finca,
            'error' => "hubo un error en el cultivo no pudo ser creado"
          ];
          $this->vista('crearcultivo/crearcultivo', $datos);
          break;
      }
    }else{
      $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
      $datos = [
        'finca' => $finca[0]->nombre_finca,
        'error' => "error debe llenar los campos"
      ];
      $this->vista('crearcultivo/crearcultivo', $datos);
    }
  }
  /*esta es la funcion encargada de mostar la vista editar la finca donde imprimin los datos actualez de la cultivo que desea cambiar*/
  public function editarCultivo($id)
  {
    $this->validarSesion();
    $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
    $cultivo = $this->cultivoModelo->retornarCultivo($id);
    $datos = [
      'finca'            => $finca[0]->nombre_finca,
      'id'               => $id,
      'id_tipo_cultivo'  => $cultivo[0]->id_tipo_cultivo,
      'area'             => $cultivo[0]->area,
      'descripcion'      => $cultivo[0]->descripcion
    ];

    $this->vista("editarcultivo/editarcultivo", $datos);
  }
  /*esta es la funcion encargada de actualzizar los cultivos haciendo una conexion con su modelo especifico */
  public function actualizarCultivo()
  {
    $this->validarSesion();
    
    if (
      !empty($_POST['id'])
      && !empty($_POST['id_tipo_cultivo'])
      && !empty($_POST['area'])
      && !empty($_POST['descripcion'])
    ) {

      switch ($_POST['id']
        && $_POST['id_tipo_cultivo']
        && $_POST['area']
        && $_POST['descripcion']) {
        case 'string':
          if ($this->validarModelo->ValidarInFloat($_POST['area'])) {
            $datos = [
              'id' => filter_var(trim($_POST['id']), FILTER_SANITIZE_NUMBER_INT),
              'id_tipo_cultivo' => filter_var(trim($_POST['id_tipo_cultivo']), FILTER_SANITIZE_STRING),
              'area' => filter_var(trim($this->validarModelo->ValidarFloat($_POST['area'])), FILTER_SANITIZE_NUMBER_FLOAT),
              'descripcion' => filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_STRING)
            ];
            if ($this->cultivoModelo->actualizarCultivo($datos)) {
              echo "<script type='text/javascript'>
                alert('cultivo editado con exito');
              </script>";
              $this->mostrarFincas();
            } else {
              $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
              $cultivo = $this->cultivoModelo->retornarCultivo($_POST['id']);
              array_push($cultivo, " error al editar el cultivo ");
              $datos = [
                'finca'            => $finca[0]->nombre_finca,
                'id'               => $_POST['id'],
                'id_tipo_cultivo'  => $cultivo[0]->id_tipo_cultivo,
                'area'             => $cultivo[0]->area,
                'descripcion'      => $cultivo[0]->descripcion,
                'error'            => $cultivo[1]
              ];
              $this->vista('editarcultivo/editarcultivo', $datos);
            }
          } else {
            $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
            $cultivo = $this->cultivoModelo->retornarCultivo($_POST['id']);
            array_push($cultivo, " el nit no es un numero entero valido ");
            $datos = [
              'finca'            => $finca[0]->nombre_finca,
              'id'               => $_POST['id'],
              'id_tipo_cultivo'  => $cultivo[0]->id_tipo_cultivo,
              'area'             => $cultivo[0]->area,
              'descripcion'      => $cultivo[0]->descripcion,
              'error'            => $cultivo[1]
            ];
            $this->vista('editarcultivo/editarcultivo', $datos);
          }
          break;
        default:
          $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
          $cultivo = $this->cultivoModelo->retornarCultivo($_POST['id']);
          array_push($cultivo, " error al editar el cultivo ");
          $datos = [
            'finca'            => $finca[0]->nombre_finca,
            'id'               => $_POST['id'],
            'id_tipo_cultivo'  => $cultivo[0]->id_tipo_cultivo,
            'area'             => $cultivo[0]->area,
            'descripcion'      => $cultivo[0]->descripcion,
            'error'            => $cultivo[1]
          ];
          $this->vista('editarcultivo/editarcultivo', $datos);

          break;
      }
    }else{
      $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
      $cultivo = $this->cultivoModelo->retornarCultivo($_POST['id']);
      array_push($cultivo, " los campos deben de estar llenos ");
      $datos = [
        'finca'            => $finca[0]->nombre_finca,
        'id'               => $_POST['id'],
        'id_tipo_cultivo'  => $cultivo[0]->id_tipo_cultivo,
        'area'             => $cultivo[0]->area,
        'descripcion'      => $cultivo[0]->descripcion,
        'error'            => $cultivo[1]
      ];
      $this->vista('editarcultivo/editarcultivo', $datos);

    }
  }
  /*esta es la funcion encargada de hacer un eliminado logico a los cultivos */
  public function eliminarCultivo()
  {
    $this->validarSesion();
    $id = $_POST['valor'];
    $this->cultivoModelo->eliminarCultivo($id);
    header('Location:' . RUTA_URL . 'index/mostrarFincas');
  }
  /*esta es la funcion encargada de imprimir todos los EVENTOS que el usuario tiene disponibles en la base de datos */

  public function eventoListar($id)
  {
    $this->validarSesion();
    $_SESSION['id_finca'] = $id;
    $finca  = $this->fincaModelo->mostrarFinca($id);
    $evento = $this->eventoModelo->listarEvento($id);
    $datos = [
      'finca' => $finca[0]->nombre_finca,
      "id" => $evento,
      "titulo" => $evento
    ];

    $this->vista("evento/evento", $datos);
  }
  /*esta es la funcion encargada de mostar la vista CREAR EVENTO   */
  public function crearEvento()
  {
    $this->validarSesion();
    $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
    $datos = [
      'finca' => $finca[0]->nombre_finca,
    ];
    $this->vista("crearevento/crearevento", $datos);
  }
  /*esta es la funcion encargada de hacer un insert de los EVENTOS que el usuario necesita para la base de datos */
  public function agregarEvento()
  {
    $this->validarSesion();
    if (
      !empty($_POST['titulo'])
      && !empty($_POST['fecha'])
      && !empty($_POST['descripcion'])
    ) {
      switch ($_POST['titulo']
        && $_POST['descripcion']
        && $_POST['fecha']) {
        case 'string':
         
            $datos = [
              'id_finca' => $_SESSION['id_finca'],
              'titulo' => filter_var(trim($_POST['titulo']), FILTER_SANITIZE_STRING),
              'fecha'  => filter_var(trim($_POST['fecha']), FILTER_SANITIZE_STRING),
              'descripcion' => filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_STRING)
            ];
            if ($this->eventoModelo->insertarEvento($datos)) {
              echo "<script type='text/javascript'>
                alert('evento creado con exito');
              </script>";
              $this->mostrarFincas();
            } else {
              $finca = $this->fincaModelo->retornarFinca($_POST['id']);
              array_push($finca, "error al crear el evento");
              $datos = [
                'id_finca'     => $_POST['id_finca'],
                'nit'          => $finca[0]->nit,
                'nombre_finca' => $finca[0]->nombre_finca,
                'direccion'    => $finca[0]->direccion,
                'error'        => $finca[1]
              ];
              $this->vista("crearevento/crearevento", $datos);
            }
          
          break;
        default:

          $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
          $datos = [
            'finca' => $finca[0]->nombre_finca,
            'error' => "hubo un error en el evento no pudo ser creado"
          ];
          $this->vista('crearevento/crearevento', $datos);
          break;
      }
    }else{
      $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
      $datos = [
        'finca' => $finca[0]->nombre_finca,
        'error' => "debe llenar todos los campos"
      ];
      $this->vista('crearevento/crearevento', $datos);
    }
  }
  /*esta es la funcion encargada de mostar la vista editar la finca donde imprimin los datos actualez de la EVENTOS que desea cambiar*/
  public function editarEvento($id)
  {
    $this->validarSesion();
    $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
    $evento = $this->eventoModelo->retornarEvento($id);
    $datos = [
      'finca'            => $finca[0]->nombre_finca,
      'id'               => $id,
      'titulo'           => $evento[0]->titulo,
      'fecha'             => $evento[0]->fecha,
      'descripcion'      => $evento[0]->descripcion
    ];

    $this->vista("editarevento/editarevento", $datos);
  }
  /*esta es la funcion encargada de actualzizar los EVENTOS haciendo una conexion con su modelo especifico */
  public function actualizarEvento()
  {
    $this->validarSesion();
    if (
      !empty($_POST['id'])
      && !empty($_POST['titulo'])
      && !empty($_POST['fecha'])
      && !empty($_POST['descripcion'])
    ) {

      switch ($_POST['id']
        && $_POST['titulo']
        && $_POST['fecha']
        && $_POST['descripcion']) {
        case 'string':
          
            $datos = [
              'id' => $_POST['id'],
              'titulo' => filter_var(trim($_POST['titulo']), FILTER_SANITIZE_STRING),
              'fecha'  => filter_var(trim($_POST['fecha']), FILTER_SANITIZE_STRING),
              'descripcion' => filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_STRING)
            ];
            if ($this->eventoModelo->actualizarEvento($datos)) {
              echo "<script type='text/javascript'>
                alert('evento editado con exito');
              </script>";
              $this->mostrarFincas();
            } else { $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
            $evento = $this->eventoModelo->retornarEvento($_POST['id']);
            $datos = [
              'finca'            => $finca[0]->nombre_finca,
              'id'               => $_POST['id'],
              'titulo'           => $evento[0]->titulo,
              'fecha'             => $evento[0]->fecha,
              'descripcion'      => $evento[0]->descripcion,
              'error'            => "error al editar el evento"
            ];

            $this->vista("editarevento/editarevento", $datos);
            }
          
          break;

        default:

          $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
          $evento = $this->eventoModelo->retornarEvento($_POST['id']);
          $datos = [
            'finca'            => $finca[0]->nombre_finca,
            'id'               => $_POST['id'],
            'titulo'           => $evento[0]->titulo,
            'fecha'             => $evento[0]->fecha,
            'descripcion'      => $evento[0]->descripcion,
            'error'            => "error al editar el evento"
          ];

          $this->vista("editarevento/editarevento", $datos);
           break;
      }
    }else{
      $finca  = $this->fincaModelo->mostrarFinca($_SESSION['id_finca']);
      $evento = $this->eventoModelo->retornarEvento($_POST['id']);
      $datos = [
        'finca'            => $finca[0]->nombre_finca,
        'id'               => $_POST['id'],
        'titulo'           => $evento[0]->titulo,
        'fecha'             => $evento[0]->fecha,
        'descripcion'      => $evento[0]->descripcion,
        'error'            => "error debe  llenar todos los campos"
      ];

      $this->vista("editarevento/editarevento", $datos);
        }
  }
  /*esta es la funcion encargada de hacer un eliminado logico a los EVENTOS */
  public function eliminarEvento()
  {
    $this->validarSesion();
    $id = $_POST['valor'];
    $id = $this->validarModelo->ValidarEntero($id);
    $this->eventoModelo->eliminarEvento($id);
    header('Location:' . RUTA_URL . 'index/mostrarFincas');
  }
  //esta es la funcion encargada de mostrar la vista principal del madministrador 
  public function admin()
  {
    $this->validarSesion();
    $usuario = $this->usuarioModelo->listarUsuario();
    $datos = [
      'nombre' => $usuario,
      'telefono' => $usuario,
      'usuario' => $usuario,
      'contrasena' => $usuario,
      'id_rol' => $usuario,
    ];
    $this->vista("index2/index2", $datos);
  }
  //esta es la funcion encargada de mostrar las guias del administrador
  public function mostrarGuiaAdmin()
  {
    $this->validarSesion();
    $guia = $this->guiasModelo->listarGuiasAdmin();
    $datos = [
      'id' => $guia,
      'titulo' => $guia,
      'tipo' => $guia,
      'contenido' => $guia
    ];
    $this->vista("gestionguiaadmin/gestionguiaadmin", $datos);
  }
  //esta es la vista encargada de mostrar la  vista para crear usuarios
  public function crearusuarioadmin()
  {
    $this->validarSesion();
    $this->vista("crearusuarioadmin/crearusuarioadmin");
  }
  //esta es la funcion para agregar los usuarios administradores
  public function agregarAdmin()
  {
    $this->validarSesion();
    if (
      !empty($_POST['nombre'])
      && !empty($_POST['telefono'])
      && !empty($_POST['usuario'])
      && !empty($_POST['contrasena'])
    ) {
      switch ($_POST['nombre']
        && $_POST['telefono']
        && $_POST['usuario']
        && $_POST['contrasena']) {
        case 'string':
          if ($this->validarModelo->ValidarIngresar($_POST['telefono'])) {
            $contrasena = $this->modeloEncriptar->encrytando($_POST['contrasena']);
            $datos = [
              'nombre' => filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING),
              'telefono' => filter_var(trim($this->validarModelo->ValidarEntero($_POST['telefono'])), FILTER_SANITIZE_NUMBER_INT),
              'usuario' => filter_var(trim($_POST['usuario']), FILTER_SANITIZE_STRING),
              'contrasena' => filter_var(trim($contrasena), FILTER_SANITIZE_STRING),
              'id_rol' => 2
            ];
             if($this->usuarioModelo->agregarUsuario($datos)){
            echo "<script type='text/javascript'>
                alert('usuario creada con exito');
              </script>";
            $this->admin();
            }else{
              echo "<script type='text/javascript'>
                alert('error al crear el usuario');
              </script>";
              $this->crearusuarioadmin();
            }
          } else {
            echo "<script type='text/javascript'>
                alert('error al  crear el usuario el telefono no es un numero valido');
              </script>";
            $this->crearusuarioadmin();
          }
          break;
        default:
          echo "<script type='text/javascript'>
                alert('error al  crear el usuario');
              </script>";
          $this->crearusuarioadmin();
          break;
      }
    }
  }
  //esta es la funcion para editar los usuarios que ya estan en la base datos y verificar o cerregir sus datos 
  public function editarUsuarioAdmin($id)
  {
    $this->validarSesion();
    $admin = $this->usuarioModelo->retornarUsuario($id);

    $datos = [
      'id' => $admin[0]->id,
      'nombre' => $admin[0]->nombre,
      'telefono' => $admin[0]->telefono,
      'usuario' => $admin[0]->usuario,
      'contrasena' => $admin[0]->contrasena,
    ];
    $this->vista("editarusuarioadmin/editarusuarioadmin", $datos);
  }
  //esta es la funcion para actualizar el usuario administrador
  public function actualizarAdmin()
  {
    $this->validarSesion();
    if (
      !empty($_POST['nombre'])
      && !empty($_POST['id'])
      && !empty($_POST['telefono'])
      && !empty($_POST['usuario'])
      && !empty($_POST['contrasena'])
    ) {

      switch ($_POST['nombre']
        && $_POST['telefono']
        && $_POST['usuario']
        && $_POST['contrasena']) {
        case 'string':
          if ($this->validarModelo->ValidarIngresar($_POST['telefono'])) {
            $contrasena = $this->modeloEncriptar->encrytando($_POST['contrasena']);
            $datos = [
              'nombre' => filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING),
              'telefono' => filter_var(trim($this->validarModelo->ValidarEntero($_POST['telefono'])), FILTER_SANITIZE_NUMBER_INT),
              'usuario' => filter_var(trim($_POST['usuario']), FILTER_SANITIZE_STRING),
              'contrasena' => filter_var(trim($contrasena), FILTER_SANITIZE_STRING),
              'id'         =>  filter_var(trim($this->validarModelo->ValidarEntero($_POST['id'])), FILTER_SANITIZE_NUMBER_INT)
            ];
            if($this->usuarioModelo->actualizarUsario($datos)){
              echo "<script>
                alert('usuario editado con exito');
              </script>";
              $this->admin();      
            }else{
              $admin = $this->usuarioModelo->retornarUsuario($_POST['id']);
              array_push($admin, "error al editar el usuario");
              $datos = [
                'id' => $admin[0]->id,
                'nombre' => $admin[0]->nombre,
                'telefono' => $admin[0]->telefono,
                'usuario' => $admin[0]->usuario,
                'contrasena' => $admin[0]->contrasena,
                'error'     => $admin[1]
              ];
              $this->vista("editarusuarioadmin/editarusuarioadmin", $datos);
            }
            
          } else {
            $admin = $this->usuarioModelo->retornarUsuario($_POST['id']);
            array_push($admin, "error el telefono no es un numero valido");
            $datos = [
              'id' => $admin[0]->id,
              'nombre' => $admin[0]->nombre,
              'telefono' => $admin[0]->telefono,
              'usuario' => $admin[0]->usuario,
              'contrasena' => $admin[0]->contrasena,
              'error'     => $admin[1]
            ];
            $this->vista("editarusuarioadmin/editarusuarioadmin", $datos);
          }
          break;

        default:

          $admin = $this->usuarioModelo->retornarUsuario($_POST['$id']);
          array_push($admin, "error a editar el usuario");
          $datos = [
            'id' => $admin[0]->id,
            'nombre' => $admin[0]->nombre,
            'telefono' => $admin[0]->telefono,
            'usuario' => $admin[0]->usuario,
            'contrasena' => $admin[0]->contrasena,
            'error'     => $admin[1]
          ];
          $this->vista("editarusuarioadmin/editarusuarioadmin", $datos);
          break;
      }
    }
  }
  //esta es la funcion con la que eliminamos todos los administradores
  public function eliminarAdmin()
  {
    $this->validarSesion();
    $id = $_POST['valor'];
    $this->usuarioModelo->eliminarUsuario($id);
    $usuario = $this->usuarioModelo->listarUsuario();
    $datos = [
      'nombre' => $usuario,
      'telefono' => $usuario,
      'usuario' => $usuario,
      'contrasena' => $usuario,
    ];
    $this->vista("index2/index2", $datos);
  }
  //esta es la funcion para mostrar las vista de crear las guias 
  public function crearguiaadmin()
  {
    $this->validarSesion();
    $this->vista("crearguiaadmin/crearguiaadmin");
  }
  //esta es la funcion donde le pasamos a la vista editar guia los datos antiguos de la guia para que los pueda modificar
  public function editarGuiaAdmin($id)
  {
    $this->validarSesion();
    $guia = $this->guiasModelo->retornarGuias($id);
    $datos = [
      'id' => $guia[0]->id,
      'titulo' => $guia[0]->titulo,
      'tipo' => $guia[0]->tipo,
      'contenido' => $guia[0]->contenido,
    ];
    $this->vista("editarguiaadmin/editarguiaadmin", $datos);
  }
  //esta es la fucion donde recibimos los datos que el usuario nos envia los datos de la celda que desea modificar
  public function actualizarGuiaAdmin()
  {
    $this->validarSesion();

    if (
      !empty($_POST['id'])
      && !empty($_POST['titulo'])
      && !empty($_POST['contenido'])
    ) {

      switch ($_POST['id']
        && $_POST['titulo']
        && $_POST['contenido']) {
        case 'string':
          $datos = [
            'id' => filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING),
            'titulo' => filter_var(trim($_POST['titulo']), FILTER_SANITIZE_STRING),
            'contenido' => filter_var(trim($_POST['contenido']), FILTER_SANITIZE_STRING),
          ];
          if($this->guiasModelo->actualizarGuias($datos)){
          echo "<script>
                alert('guia editada con exito');
              </script>";
          $this->admin();
          }else{
            $guia = $this->guiasModelo->retornarGuias($_POST['$id']);
            array_push($guia, "error al editar la guia");
            $datos = [
              'id' => $guia[0]->id,
              'titulo' => $guia[0]->titulo,
              'tipo' => $guia[0]->tipo,
              'contenido' => $guia[0]->contenido,
              'error'    => $guia[1]
            ];
            $this->vista("editarguiaadmin/editarguiaadmin", $datos);  
          }
          break;

        default:
          $guia = $this->guiasModelo->retornarGuias($_POST['$id']);
          array_push($guia, "hubo un error al editar la guia");
          $datos = [
            'id' => $guia[0]->id,
            'titulo' => $guia[0]->titulo,
            'tipo' => $guia[0]->tipo,
            'contenido' => $guia[0]->contenido,
            'error'    => $guia[1]
          ];
          $this->vista("editarguiaadmin/editarguiaadmin", $datos);
          break;
      }
    } else {
      $guia = $this->guiasModelo->retornarGuias($_POST['$id']);
      array_push($guia, "hubo un error al editar la guia");
      $datos = [
        'id' => $guia[0]->id,
        'titulo' => $guia[0]->titulo,
        'tipo' => $guia[0]->tipo,
        'contenido' => $guia[0]->contenido,
        'error'    => $guia[1]
      ];
      $this->vista("editarguiaadmin/editarguiaadmin", $datos);
    }
  }
  
  //esta es la funcion donde imprimimos todos los formatos para el administrador
  public function formatoadmin()
  {
    $this->validarSesion();
    $formato = $this->formatoModelo->listarFormatos();
    $datos = [
      "formato"       => $formato,
    ];
    $this->vista("formatoadmin/formatoadmin", $datos);
  }
  public function tipsadmin()
  {
    $this->validarSesion();
    $carrusel = $this->carruselModelo->listarCarrusel();
    $datos = [
      "carrusel"       => $carrusel,
    ];

    $this->vista('tipsadmin/tipsadmin', $datos);
  }
  //esta es la funcion para agregar los formatos  a su carpeta correspondiente 
  public function AgregarFormato()
  {
    $this->validarSesion();
    $count = $this->formatoModelo->ConteoFormatos();
    $ent = $count[0]['MAX(id_formatos)'];    
    $ent = $ent + 1;
    $pdf = $_FILES["pdf"]["name"];
    $tipo = stristr($pdf, '.');
    $nombre = "archivo" . $ent . $tipo;

    $ubicacion = $_FILES["pdf"]["tmp_name"];
    $destino = DIRECTORIO . $nombre;
    move_uploaded_file($ubicacion, $destino);
    $ruta = $destino;

    if (!empty($pdf)) {
      $datos = [
        'nombre'  => $nombre,
        'url'     => $ruta,
      ];
      $this->formatoModelo->Agregarformatos($datos);
    }
    $this->formatoadmin();
  }
  //esta funcion hace un barrado logico de la base de datos del archivo en especifico y ademas lo elimina de la carpeta raiz 
  public function formatoEliminar()
  {
    $this->validarSesion();
    $id = $_POST['valor'];
    $name = $this->formatoModelo->retornarFormato($id);
    $this->formatoModelo->eliminarFormato($id);
    $name = $name[0]->nombre_formatos;
    $run = $this->modeloEliminar->eliminar($name);
    $this->formatoadmin();
  }
  //esta es la funcion mostrat la vista de agregar los tips
  public function Agregartips()
  {
    $this->validarSesion();
    $this->vista("creartipadmin/creartipadmin");
  }
  //esat es la funcion que nos permite recbir todos los datos de la vista y enviarlos a todos los modelos
  public function Creartips()
  {
    $this->validarSesion();
    if (!empty($_POST['titulo']) && !empty($_POST['contenido'])) {
      $titulo = $_POST['titulo'];
      $contenido = $_POST['contenido'];
      $datos = [
        'titulo' => $titulo,
        'contenido' => $contenido
      ];
      $this->carruselModelo->agregarTips($datos);
      $this->formatoadmin();
    }
  }
  //esta es la funcion que nos permite mostrar los datos del tips anteriror para que el usuario lo pueda editar
  public function Editartips($id)
  {
    $this->validarSesion();
    $tip = $this->carruselModelo->retornarTips($id);
    $datos = [
      'id'        => $tip[0]->id,
      'nombre'    => $tip[0]->nombre,
      'contenido' => $tip[0]->contenido,
      'estado'    => $tip[0]->estado,
    ];
    $this->vista("editartipadmin/editartipadmin", $datos);
  }

  //esta es la funcion para actualizar los datos que el usuario envie de los tips
  public function Actualizartip()
  {
    $this->validarSesion();
    if (
      !empty($_POST['id'])
      && !empty($_POST['titulo'])
      && !empty($_POST['contenido'])
      && !empty($_POST['estado'])
    ) {
      switch ($_POST['id']
              && $_POST['titulo']
              && $_POST['contenido']
              && $_POST['estado']) {
        case 'string':
          $datos = [
            'id' => filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING),
            'titulo' => filter_var(trim($_POST['titulo']), FILTER_SANITIZE_STRING),
            'contenido' => filter_var(trim($_POST['contenido']), FILTER_SANITIZE_STRING),
          ];
          if($this->carruselModelo->actualizarTips($datos)){
            echo "<script>
                alert('tip actualizado con exito');
              </script>";
            $this->admin();
          
          }else{
            $tip = $this->carruselModelo->retornarTips($_POST['id']);
            $datos = [
              'id'        => $tip[0]->id,
              'nombre'    => $tip[0]->nombre,
              'contenido' => $tip[0]->contenido,
              'estado'    => $tip[0]->estado,
              'error'     => "error al editar el tip"
            ];
            $this->vista("editartipadmin/editartipadmin", $datos);
          }
          
          break;

        default:
          $tip = $this->carruselModelo->retornarTips($_POST['id']);
          $datos = [
            'id'        => $tip[0]->id,
            'nombre'    => $tip[0]->nombre,
            'contenido' => $tip[0]->contenido,
            'estado'    => $tip[0]->estado,
          ];
          $this->vista("editartipadmin/editartipadmin", $datos);
          break;
      }
    }else{
      $tip = $this->carruselModelo->retornarTips($_POST['id']);
      $datos = [
        'id'        => $tip[0]->id,
        'nombre'    => $tip[0]->nombre,
        'contenido' => $tip[0]->contenido,
        'estado'    => $tip[0]->estado,
        'error'     => "error al editar el tip"
      ];
      $this->vista("editartipadmin/editartipadmin", $datos);
      
  }
}
  //esta es la funcion encargada de hacer el eliminaadoi logico de la base de datos 
  public function eliminarTip()
  {
    $this->validarSesion();
    $id = $_POST['valor'];
    $this->carruselModelo->eliminarTip($id);
    $this->formatoadmin();
  }
}
