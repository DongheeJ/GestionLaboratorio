<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require (__DIR__ . '/../persistencia/AsignaturaDAO.php');

class Asignatura{
    private $idAsignatura;
    private $nombre;

    public function consultarTodos(){
        $asignaturas = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $asignaturaDAO = new AsignaturaDAO();
        $conexion -> ejecutarConsulta($asignaturaDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){            
            $asignatura = new Asignatura($registro[0], $registro[1]);
            array_push($asignaturas, $asignatura);
        }
        $conexion -> cerrarConexion();
        return $asignaturas;        
    }
    public function registrar($nombre = "")
    {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $asignaturaDAO = new AsignaturaDAO();
        $conexion->ejecutarConsulta($asignaturaDAO->registrar($nombre));
        $conexion->cerrarConexion();
        return true;
    }
    public function eliminar($ids){
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $asignaturaDAO = new AsignaturaDAO();
        foreach($ids as $id){
            $conexion->ejecutarConsulta($asignaturaDAO->eliminar($id));
        }
        $conexion->cerrarConexion();
    }
    public function __construct($idAsignatura=0, $nombre=""){
        $this -> idAsignatura = $idAsignatura;
        $this -> nombre = $nombre;
    }
    public function getIdAsignatura(){return $this->idAsignatura; }
    public function setIdAsignatura($idAsignatura){$this->idAsignatura = $idAsignatura; }
    public function getNombre(){return $this->nombre; }
    public function setNombre($nombre){$this->nombre = $nombre; }
}
?>