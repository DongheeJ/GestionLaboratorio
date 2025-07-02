<?php
class UsuarioDAO{
    private $idUsuario;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    
    public function __construct($idUsuario=0, $nombre="", $apellido="", $correo="", $clave=""){
        $this -> idUsuario = $idUsuario;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }
    
    public function consultarTodos(){
        return "SELECT idUsuario,nombre,apellido,correo,clave FROM Usuario;";
    }
    public function consultarId($idUsuario){
        return "SELECT idUsuario,nombre,apellido,correo,clave FROM Usuario WHERE idUsuario = $idUsuario;";
    }
    public function consultarCorreo($correo,$clave){
        return "SELECT idUsuario,nombre,apellido,correo,clave
        FROM Usuario
        WHERE correo = '$correo' AND clave = '$clave';";
    }
    public function registrar($nombre,$apellido,$correo,$clave){
        return "INSERT INTO Usuario (nombre,apellido,correo,clave) 
        VALUES ('$nombre','$apellido','$correo','$clave');";
    }
    public function cambiarClave($correo,$clave){
        return "UPDATE Usuario
        SET clave = '$clave'
        WHERE correo = '$correo';";
    }
}

?>