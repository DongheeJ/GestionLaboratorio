<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require (__DIR__ . '/../persistencia/UsuarioDAO.php');

class Usuario{
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
    public function mapearUsuariosPorId(){
        $usuarios = [];
        
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $usuarioDAO = new UsuarioDAO();
        $conexion -> ejecutarConsulta($usuarioDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){            
            $usuario = new Usuario($registro[0], $registro[1],$registro[2],$registro[3],$registro[4]);
            $usuarios[$registro[0]] = $usuario;
        }
        $conexion -> cerrarConexion();
        return $usuarios;   
    }
    public function consultarTodos(){
        $usuarios = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $usuarioDAO = new UsuarioDAO();
        $conexion -> ejecutarConsulta($usuarioDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){            
            $usuario = new Usuario($registro[0], $registro[1],$registro[2],$registro[3],$registro[4]);
            array_push($usuarios, $usuario);
        }
        $conexion -> cerrarConexion();
        return $usuarios;        
    }
    public function consultarId($idUsuario){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $usuarioDAO = new UsuarioDAO();
        $conexion->ejecutarConsulta($usuarioDAO->consultarId($idUsuario));
        $registro = $conexion->siguienteRegistro();
        $this->idUsuario = $registro[0];
        $this->nombre = $registro[1];
        $this->apellido = $registro[2];
        $this->correo = $registro[3];
        $this->clave = $registro[4];
        $conexion -> cerrarConexion();
    } 
    public function autenticar($correo,$clave){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $usuarioDAO = new UsuarioDAO();
        $conexion -> ejecutarConsulta($usuarioDAO -> consultarCorreo($correo,$clave));
        if($conexion -> numeroFilas() == 0){
            $conexion -> cerrarConexion();
            return false;
        }
        $registro = $conexion -> siguienteRegistro();
        $this->idUsuario = $registro[0];
        $this->nombre = $registro[1];
        $this->apellido = $registro[2];
        $this->correo = $registro[3];
        $this->clave = $registro[4];
        $conexion -> cerrarConexion();
        return true;
    }
    public function registrar($nombre,$apellido,$correo,$clave){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $usuarioDAO = new UsuarioDAO();
        $conexion->ejecutarConsulta($usuarioDAO->registrar(
            $nombre, $apellido, $correo, $clave
        ));
        $conexion->cerrarConexion();
        return true;
    }
    public function cambiarClave($correo,$clave){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $usuarioDAO = new UsuarioDAO();
        $conexion->ejecutarConsulta($usuarioDAO->cambiarClave(
            $correo, $clave
        ));
        $conexion->cerrarConexion();
        return true;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getClave()
    {
        return $this->clave;
    }
    public function setClave($clave)
    {
        $this->clave = $clave;
    }
}

?>