<?php
include (__DIR__ . '/../presentacion/navbar.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["registrar"])) {
    $firmaFilePath = "";

    if (!empty($_POST["signature"])) {
        $signatureData = $_POST["signature"];
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData); // Eliminamos el header Base64
        $signatureData = base64_decode($signatureData); // Decodificación Base64

        // Generamos un nombre único para la imagen y la guardamos
        $firmaFilePath = 'img/firma/' . uniqid() . '.png';
        file_put_contents('C:/xampp/htdocs/GestionLaboratorio/' . $firmaFilePath, $signatureData);
    }
    
    $asistencia = new Asistencia();
    $asistencia->registrar(
        date("Y-m-d"),
        $_POST["proyectoC"],
        $_POST["actividad"],
        $_POST["asignatura"],
        $_POST["docente"],
        $_POST["codigoGrupo"],
        intval($_POST["nEstudiantes"]),
        $_POST["horaEntrada"],
        $_POST["horaSalida"],
        $firmaFilePath, // Guardamos la ruta de la imagen de la firma
        $_SESSION["usuario"]->getIdUsuario()
    );
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$proyectoC = new ProyectoC();
$carreras = $proyectoC->consultarTodos();
$mapCarreras = [];
foreach($carreras as $temp) {
    $mapCarreras[$temp->getNombre()] = $temp->getCodigo();
}
$asignatura = new Asignatura();
$asignaturas = $asignatura->consultarTodos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Usamos Bootstrap 5.3 para un diseño moderno -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>GestionLaboratorio</title>
    <style>
    /* Mejoras en diseño personalizado */
    body {
        background-color: #f8f9fa;
    }

    .card {
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }

    canvas {
        background-color: #fff;
        cursor: crosshair;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Registro de Asistencia</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_POST["registrar"])) { ?>
                        <div class="alert alert-success" role="alert">
                            Formulario registrado exitosamente.
                        </div>
                        <?php } ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <!-- Proyecto Curricular con autocompletado -->
                            <div class="mb-3">
                                <label for="proyectoC" class="form-label">Proyecto Curricular</label>
                                <input type="text" id="proyectoC" name="proyectoC" class="form-control"
                                    list="proyectoC_list" placeholder="Seleccione o escriba..." autocomplete="off" required>
                                <datalist id="proyectoC_list">
                                    <?php foreach($carreras as $temp): ?>
                                    <option value="<?= htmlspecialchars($temp->getNombre()) ?>"></option>
                                    <?php endforeach; ?>
                                </datalist>
                            </div>

                            <div class="mb-3">
                                <label for="actividad" class="form-label">Equipo / Practica / Clase</label>
                                <input type="text" name="actividad" id="actividad" class="form-control"
                                    placeholder="Ingrese actividad" required>
                            </div>

                            <!-- Asignatura con listado -->
                            <div class="mb-3">
                                <label for="asignatura" class="form-label">Asignatura</label>
                                <input type="text" name="asignatura" id="asignatura" class="form-control"
                                    list="asignatura_list" placeholder="Seleccione asignatura" required>
                                <datalist id="asignatura_list">
                                    <?php foreach($asignaturas as $temp): ?>
                                    <option value="<?= htmlspecialchars($temp->getNombre()) ?>">
                                        <?= htmlspecialchars($temp->getNombre()) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </datalist>
                            </div>

                            <div class="mb-3">
                                <label for="docente" class="form-label">Nombre del Docente</label>
                                <input type="text" name="docente" id="docente" class="form-control"
                                    placeholder="Ingrese el nombre del docente" required>
                            </div>

                            <div class="mb-3">
                                <label for="codigoGrupo" class="form-label">Código del Grupo</label>
                                <input type="text" name="codigoGrupo" id="codigoGrupo" class="form-control"
                                    placeholder="Código de grupo" required>
                            </div>

                            <div class="mb-3">
                                <label for="nEstudiantes" class="form-label">Número de Estudiantes</label>
                                <input type="number" name="nEstudiantes" id="nEstudiantes" class="form-control"
                                    placeholder="Número de estudiantes" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="horaEntrada" class="form-label">Hora de Entrada</label>
                                    <input type="time" name="horaEntrada" id="horaEntrada" class="form-control"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="horaSalida" class="form-label">Hora de Salida</label>
                                    <input type="time" name="horaSalida" id="horaSalida" class="form-control" required>
                                </div>
                            </div>

                            <!-- Sección de Firma -->
                            <div class="mb-3">
                                <label class="form-label">Firma:</label>
                                <div class="mb-2">
                                    <canvas id="signatureCanvas" width="500" height="200" class="border"></canvas>
                                </div>
                                <button type="button" onclick="clearCanvas()" class="btn btn-secondary btn-sm">
                                    Borrar Firma
                                </button>
                                <input type="hidden" name="signature" id="signatureData">
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="registrar" class="btn btn-primary">
                                    Registrar Asistencia
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>

    <!-- Script para autocompletar el código del grupo -->
    <script>
    const mapCarreras = <?= json_encode($mapCarreras, JSON_UNESCAPED_UNICODE) ?>;
    const inpProyecto = document.getElementById('proyectoC');
    const inpCodigo = document.getElementById('codigoGrupo');

    inpProyecto.addEventListener('input', () => {
        const nombre = inpProyecto.value;
        const codigo = mapCarreras[nombre];
        if (codigo !== undefined) {
            inpCodigo.value = `${codigo} - `;
        } else {
            inpCodigo.value = '';
        }
    });
    </script>

    <!-- Scripts para manejar la firma en el canvas -->
    <script>
    const canvas = document.getElementById('signatureCanvas');
    const context = canvas.getContext('2d');
    let isDrawing = false;

    canvas.addEventListener('mousedown', () => {
        isDrawing = true;
    });
    canvas.addEventListener('mouseup', () => {
        isDrawing = false;
        context.beginPath();
    });
    canvas.addEventListener('mousemove', draw);

    function draw(event) {
        if (!isDrawing) return;
        context.lineWidth = 2;
        context.lineCap = 'round';
        context.strokeStyle = '#000';
        context.lineTo(event.offsetX, event.offsetY);
        context.stroke();
        context.beginPath();
        context.moveTo(event.offsetX, event.offsetY);
    }

    function clearCanvas() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    }

    document.querySelector('form').addEventListener('submit', () => {
        document.getElementById('signatureData').value = canvas.toDataURL('image/png');
    });
    </script>
</body>

</html>