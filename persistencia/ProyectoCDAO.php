<?php
class ProyectoCDAO{
    public function consultarTodos(){
        return "SELECT idProyectoC,nombre,codigo
        FROM ProyectoC;";
    }
    public function registrar($nombre,$codigo){
        return "INSERT INTO ProyectoC (nombre,codigo) 
        VALUES ('$nombre','$codigo');";
    }
    public function eliminar($id){
        return "DELETE FROM ProyectoC where idProyectoC = $id";
    }
}
?>