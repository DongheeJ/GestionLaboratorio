<?php
require (__DIR__ . '/../logica/Asistencia.php');
require (__DIR__ . '/../logica/ProyectoC.php');
require (__DIR__ . '/../logica/Asignatura.php');
session_start();

if (isset($_GET["cerrarSesion"])||!isset($_SESSION["usuario"])) {

    $_SESSION = [];
    session_destroy();

    header("Location: /GestionLaboratorio/index.php");
}
$usuario = $_SESSION["usuario"];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/GestionLaboratorio/presentacion/registroFormulario.php">
            Gestión Laboratorio
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/GestionLaboratorio/presentacion/registroFormulario.php">Registro Asistencia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/GestionLaboratorio/presentacion/asistencia/asistencia.php">Asistencias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/GestionLaboratorio/presentacion/asistencia/asistenciaMensual.php">Asistencia Mensual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/GestionLaboratorio/presentacion/asistencia/asistenciaFiltrado.php">Asistencia Filtrado</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="mantenimientoDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Mantenimiento
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="mantenimientoDropdown">
                        <li><a class="dropdown-item" href="/GestionLaboratorio/presentacion/mantenimiento/proyectoC.php">Proyecto Curricular</a></li>
                        <li><a class="dropdown-item" href="/GestionLaboratorio/presentacion/mantenimiento/asignatura.php">Asignatura</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?php echo $usuario->getNombre() . " " . $usuario->getApellido(); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?cerrarSesion=true">
                                Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
