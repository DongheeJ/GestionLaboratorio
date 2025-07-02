<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require (__DIR__ . '/../persistencia/ProyectoCDAO.php');

class ProyectoC{
    private $idProyectoC;
    private $nombre;
    private $codigo;

    public function consultarTodos(){
        $carreras = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $proyectoCDAO = new ProyectoCDAO();
        $conexion -> ejecutarConsulta($proyectoCDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){            
            $proyectoC = new ProyectoC($registro[0], $registro[1],$registro[2]);
            array_push($carreras, $proyectoC);
        }
        $conexion -> cerrarConexion();
        return $carreras;        
    }
    public function registrar($nombre = "", $codigo = "")
    {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $proyectoCDAO = new ProyectoCDAO();
        $conexion->ejecutarConsulta($proyectoCDAO->registrar($nombre,$codigo));
        $conexion->cerrarConexion();
        return true;
    }
    public function eliminar($ids){
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $proyectoCDAO = new ProyectoCDAO();
        foreach($ids as $id){
            $conexion->ejecutarConsulta($proyectoCDAO->eliminar($id));
        }
        $conexion->cerrarConexion();
    }
    public function __construct($idProyectoC=0, $nombre="", $codigo=""){
        $this -> idProyectoC = $idProyectoC;
        $this -> nombre = $nombre;
        $this -> codigo = $codigo;
    }
    public function getIdProyectoC(){return $this->idProyectoC; }
    public function setIdProyectoC($idProyectoC){$this->idProyectoC = $idProyectoC; }
    public function getNombre(){return $this->nombre; }
    public function setNombre($nombre){$this->nombre = $nombre; }
    public function getCodigo(){return $this->codigo; }
    public function setCodigo($codigo){$this->codigo = $codigo; }
}
?>