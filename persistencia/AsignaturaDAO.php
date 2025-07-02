<?php
class AsignaturaDAO{
    public function consultarTodos(){
        return "SELECT idAsignatura,nombre
        FROM Asignatura;";
    }
    public function registrar($nombre){
        return "INSERT INTO Asignatura (nombre) 
        VALUES ('$nombre');";
    }
    public function eliminar($id){
        return "DELETE FROM Asignatura where idAsignatura = $id";
    }
}
?>