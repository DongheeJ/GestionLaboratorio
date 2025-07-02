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
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .form-control,
    .form-select {
        border-radius: 0.5rem;
    }
    </style>
</head>

<body>
    <?php
    ob_start();
    include (__DIR__ . '/../../presentacion/navbar.php');
    $proyectoC = new ProyectoC();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["agregar"])) {
        $proyectoC ->registrar($_POST["nombre"],$_POST["codigo"]);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit(); 
    }
    $carreras = $proyectoC -> consultarTodos();
    ?>

    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Filtro a la izquierda -->
            <div class="col-md-3">
                <div class="sidebar">
                    <div class="addPy-title">Registrar proyecto curricular</div>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <input type="hidden" name="agregar" value="1">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del proyecto curricular</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="codigo" class="form-label">codigo</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" 
                            placeholder="ej:578-117" required>
                        </div>

                        <!-- Botón Buscar -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabla a la derecha -->
            <div class="col-md-9">
                <div class="table-container">
                    <?php
                    include (__DIR__ . '/../../presentacion/mantenimiento/tablaPy.php');
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