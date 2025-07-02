<?php
require (__DIR__ . '/../logica/Usuario.php');
if (isset($_POST["registrarse"])) {
    $usuario = new Usuario();
    $usuario->registrar($_POST["nombre"], $_POST["apellido"], $_POST["correo"], $_POST["clave"]);
    header("Location: /GestionLaboratorio/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrarse - Gestión Laboratorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 2rem;
            padding-bottom: 2rem;
            margin: 0;
        }
        .register-card {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .logo-placeholder {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .logo-placeholder h4 {
            color: #0d6efd;
            font-weight: bold;
        }
        .form-label {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="card register-card">
        <div class="card-body">
            <div class="logo-placeholder">
                <h4>Gestión de Laboratorio</h4>
            </div>

            <h5 class="card-title text-center mb-4">Registrarse</h5>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Tu nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Tu apellido" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="tu@correo.com" required>
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" name="clave" id="clave" class="form-control" placeholder="Tu contraseña" required>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" name="registrarse" class="btn btn-success btn-lg">Registrarse</button>
                </div>

                <hr class="my-4">

                <div class="text-center">
                    <p class="mb-1">¿Ya tienes una cuenta?</p>
                    <a href="/GestionLaboratorio/index.php">Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>
</html>