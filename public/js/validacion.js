function validar(){
    var usuario, clave, expresion;
    usuario = document.getElementById("usuario").value;
    clave = document.getElementById("clave").value;

    if( usuario === "" || clave === ""){
        alert("Todos los campos son obligatorios");
        return false;
    }else if(usuario.length>20 || clave.length>20){
        alert("El nombre del usuario o la contraseña son muy largas");
        return false;
    }
}

