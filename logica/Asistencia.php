<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require (__DIR__ . '/../persistencia/AsistenciaDAO.php');
require_once (__DIR__ . '/../logica/Usuario.php');

class Asistencia{
    private $datos = [];

    public function __construct($idAsistencia = 0, $fecha = "", $proyectoC = "", $actividad = "", $asignatura = "", $docente = "", $codigoGrupo = "", $numeroEstudiante = 0, $horaEntrada = "", $horaSalida = "", $firma = "", $usuario = null) {
        $this->datos['idAsistencia'] = $idAsistencia;
        $this->datos['fecha'] = $fecha;
        $this->datos['proyectoC'] = $proyectoC;
        $this->datos['actividad'] = $actividad;
        $this->datos['asignatura'] = $asignatura;
        $this->datos['docente'] = $docente;
        $this->datos['codigoGrupo'] = $codigoGrupo;
        $this->datos['numeroEstudiante'] = $numeroEstudiante;
        $this->datos['horaEntrada'] = $horaEntrada;
        $this->datos['horaSalida'] = $horaSalida;
        $this->datos['firma'] = $firma;
        $this->datos['usuario'] = $usuario;
    }

    public function __get($propiedad) {
        return $this->datos[$propiedad] ?? null;
    }

    public function __set($propiedad, $valor) {
        $this->datos[$propiedad] = $valor;
    }
    
    public function registrar($fecha = "", $proyectoC = "", $actividad = "", $asignatura = "", $docente = "", $codigoGrupo = "", $numeroEstudiante = 0, $horaEntrada = "", $horaSalida = "", $firma = "", $idUsuario = 0)
    {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $asistenciaDAO = new AsistenciaDAO();
        $conexion->ejecutarConsulta($asistenciaDAO->registrar(
            $fecha, $proyectoC, $actividad, $asignatura, $docente, $codigoGrupo, $numeroEstudiante, $horaEntrada , $horaSalida, $firma, $idUsuario
        ));
        $conexion->cerrarConexion();
        return true;
    }
    public function eliminar($idAsistencias){
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $asistenciaDAO = new AsistenciaDAO();
        foreach($idAsistencias as $id){
            $conexion->ejecutarConsulta($asistenciaDAO->consultarId($id));
            $registro = $conexion->siguienteRegistro();
            
            unlink(__DIR__ . '/../img/firma/' . basename($registro[10]));
            $conexion->ejecutarConsulta($asistenciaDAO->eliminar($id));
        }
        $conexion->cerrarConexion();
    }
    public function consultarTodos(){
        $asistencias = array();
        $usuario = new Usuario();
        $usuarios = $usuario -> mapearUsuariosPorId();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $asistenciaDAO = new AsistenciaDAO();
        $conexion -> ejecutarConsulta($asistenciaDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){            
            $asistencia = new Asistencia($registro[0], $registro[1],$registro[2]
            ,$registro[3],$registro[4],$registro[5],$registro[6]
            ,$registro[7],$registro[8],$registro[9],$registro[10],$usuarios[$registro[11]]);
            array_push($asistencias, $asistencia);
        }
        $conexion -> cerrarConexion();
        return $asistencias;        
    }

    public function filtrar($id,$year_start=null,$month_start=null,$year_end=null,$month_end=null,$proyectoC_array=null,$asignaturas_array=null){
        $asistencias = array();
        $usuario = new Usuario();
        $usuarios = $usuario -> mapearUsuariosPorId();

        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $asistenciaDAO = new AsistenciaDAO();
        $conexion -> ejecutarConsulta($asistenciaDAO -> consultarFiltrado($id,$year_start,$month_start,$year_end,$month_end,$proyectoC_array,$asignaturas_array));
        while($registro = $conexion -> siguienteRegistro()){     
            $asistencia = new Asistencia($registro[0], $registro[1],$registro[2]
            ,$registro[3],$registro[4],$registro[5],$registro[6]
            ,$registro[7],$registro[8],$registro[9],$registro[10],$usuarios[$registro[11]]);
            array_push($asistencias, $asistencia);
        }
        $conexion -> cerrarConexion();
        return $asistencias; 
    }
}

?>