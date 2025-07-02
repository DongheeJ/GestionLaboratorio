<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tagify CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@yaireo/tagify/dist/tagify.css">

    <!-- Tagify JS -->
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>GestionLaboratorio</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2rem 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }
        .filter-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .table-container {
            padding-bottom: 0.5rem;
            width: 100%;
            padding: 1rem;
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .form-select {
            border-radius: 0.5rem;
        } 
        .btn-area {
        margin-top: 0.5rem; /* 버튼과 테이블 간의 거리 */
        }
    </style>
</head>

<body>
    <?php
    include (__DIR__ . '/../../presentacion/navbar.php');
    $proyectoC = new ProyectoC();
    $carreras = $proyectoC -> consultarTodos();
    $asignatura = new Asignatura();
    $asignaturas = $asignatura -> consultarTodos();
    ?>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Filtro a la izquierda -->
            <div class="col-auto" style="width: 220px;">
                <div class="sidebar">
                    <?php include (__DIR__ . '/../../presentacion/asistencia/filtroAsistencia.php');?>
                </div>
            </div>

            <!-- Tabla a la derecha -->
            <div class="col-md-10">
                <div class="table-container">
                    <?php
                    $asistencia = new Asistencia();

                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET["filtrar"])) {
                        $asistencias = $asistencia->filtrar($_SESSION["usuario"]->getIdUsuario());
                    } else {
                        $proyectoC = isset($_GET["proyectoC"]) ? json_decode($_GET["proyectoC"], true) : [];
                        $asignatura = isset($_GET["asignatura"]) ? json_decode($_GET["asignatura"], true) : [];

                        $proyectoC_array = is_array($proyectoC) ? array_column($proyectoC, 'value') : [];
                        $asignaturas_array = is_array($asignatura) ? array_column($asignatura, 'value') : [];

                        $asistencias = $asistencia->filtrar(
                            $_SESSION["usuario"]->getIdUsuario(),
                            $_GET["year_start"],
                            $_GET["month_start"],
                            $_GET["year_end"],
                            $_GET["month_end"],
                            $proyectoC_array,
                            $asignaturas_array
                        );
                    }

                    include (__DIR__ . '/../../presentacion/asistencia/tablaAsistencia.php');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>


<script>
// PHP에서 받은 $carreras 값을 JS 배열로 변환
const carreras = [
    <?php foreach($carreras as $temp): ?> "<?php echo $temp->getNombre(); ?>",
    <?php endforeach; ?>
];
const asignaturas = [
    <?php foreach($asignaturas as $temp): ?> "<?php echo $temp->getNombre(); ?>",
    <?php endforeach; ?>
];
const inputProyecto = document.getElementById('proyectoC');
const tagifyProyecto = new Tagify(inputProyecto, {
    whitelist: carreras,
    dropdown: {
        enabled: 1, // 최소 1글자 입력하면 바로 제안
        maxItems: 10, // 최대 10개까지 제안
        classname: 'tags-look',
        position: 'text',
        closeOnSelect: false,
        highlightFirst: true
    }
});
const inputAsignatura = document.getElementById('asignatura');
const tagifyAsignatura = new Tagify(inputAsignatura, {
    whitelist: asignaturas,
    dropdown: {
        enabled: 1,
        maxItems: 10,
        classname: 'tags-look',
        position: 'text',
        closeOnSelect: false,
        highlightFirst: true
    }
});
</script>