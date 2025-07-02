<?php
require (__DIR__ . '/../logica/Asistencia.php');
require (__DIR__ . '/../logica/ProyectoC.php');
require (__DIR__ . '/../logica/Asignatura.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seleccionados'])) {
    if($_POST["table"]=="asistencia"){
    $asistencia = new Asistencia();
    $asistencia -> eliminar($_POST["seleccionados"]);
    header("Location: /GestionLaboratorio/presentacion/asistencia/asistencia.php");
    }
    if($_POST["table"]=="proyecto C"){
    $proyectoC = new ProyectoC();
    $proyectoC -> eliminar($_POST["seleccionados"]);
    header("Location: /GestionLaboratorio/presentacion/mantenimiento/proyectoC.php");
    }
    if($_POST["table"]=="asignatura"){
    $asignatura = new Asignatura();
    $asignatura -> eliminar($_POST["seleccionados"]);
    header("Location: /GestionLaboratorio/presentacion/mantenimiento/asignatura.php");
    }
}
else {
    echo "No se seleccionaron registros.";
}
?>
