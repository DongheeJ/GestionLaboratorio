<?php
class AsistenciaDAO{
    public function registrar(        
        $fecha = "", $proyectoC = "", $actividad = "", $asignatura = "", $docente = "", $codigoGrupo = "", $numeroEstudiante = 0, $horaEntrada = "", $horaSalida = "", $firma = "", $idUsuario = 0
    ){
        return "INSERT into Asistencia 
        (fecha,proyectoC,actividad,asignatura,docente,codigoGrupo,numeroEstudiante,horaEntrada,horaSalida,firma,Usuario_idUsuario)
        VALUES
        ('$fecha', '$proyectoC', '$actividad', '$asignatura', '$docente', '$codigoGrupo', $numeroEstudiante, '$horaEntrada', '$horaSalida','$firma',$idUsuario)";
    }
    public function eliminar($id){
        return "DELETE FROM asistencia where idAsistencia = $id";
    }
public function consultarTodos(){
    return "SELECT idAsistencia, fecha, proyectoC, actividad, asignatura, docente, codigoGrupo, numeroEstudiante, 
        TIME_FORMAT(horaEntrada, '%h:%i %p') AS horaEntrada, 
        TIME_FORMAT(horaSalida, '%h:%i %p') AS horaSalida, 
        firma, Usuario_idUsuario
    FROM Asistencia;";
}
    public function consultarId($id){
        return "SELECT idAsistencia, fecha, proyectoC, actividad, asignatura, docente, codigoGrupo, numeroEstudiante, 
            TIME_FORMAT(horaEntrada, '%h:%i %p') AS horaEntrada, 
            TIME_FORMAT(horaSalida, '%h:%i %p') AS horaSalida, 
            firma, Usuario_idUsuario
        FROM Asistencia WHERE idAsistencia = $id;";
    }

    public function consultarFiltrado($id,$year_start=null,$month_start=null,$year_end=null,$month_end=null,$proyectoCs=null,$asignaturas=null){
        $query = "SELECT idAsistencia, fecha, proyectoC, actividad, asignatura, docente, codigoGrupo, numeroEstudiante, 
            TIME_FORMAT(horaEntrada, '%h:%i %p') AS horaEntrada, 
            TIME_FORMAT(horaSalida, '%h:%i %p') AS horaSalida, 
            firma, Usuario_idUsuario 
        FROM Asistencia WHERE Usuario_idUsuario = $id";

if (is_numeric($year_start) && !is_numeric($year_end)) {
    $query .= " AND YEAR(fecha) = $year_start";
} elseif (!is_numeric($year_start) && is_numeric($year_end)) {
    $query .= " AND YEAR(fecha) = $year_end";
} elseif (is_numeric($year_start) && is_numeric($year_end)) {
    $query .= " AND YEAR(fecha) BETWEEN $year_start AND $year_end";
}

if (is_numeric($month_start) && !is_numeric($month_end)) {
    $query .= " AND MONTH(fecha) = $month_start";
} elseif (!is_numeric($month_start) && is_numeric($month_end)) {
    $query .= " AND MONTH(fecha) = $month_end";
} elseif (is_numeric($month_start) && is_numeric($month_end)) {
    $query .= " AND MONTH(fecha) BETWEEN $month_start AND $month_end";
}

        if ($proyectoCs != null) {
            $quoted_carreras = array_map(function($carrera) {
                return "'" . addslashes($carrera) . "'";
            }, $proyectoCs);
            $proyectoC_str = implode(',', $quoted_carreras);
            $query .= " AND proyectoC IN ($proyectoC_str)";
        }

        if ($asignaturas != null) {
            $like_conditions = array_map(function($materia) {
                return "asignatura LIKE '" . addslashes($materia) . "%'";
            }, $asignaturas);
            $query .= " AND (" . implode(" OR ", $like_conditions) . ")";
        }

        return $query;
    }
}

?>