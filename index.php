<?php
require ("logica/Asistencia.php");
$error = false;
if (isset($_POST["autenticar"])) {
    $usuario = new Usuario();
    if($usuario->autenticar($_POST["correo"], $_POST["clave"])){
        session_start();
        $_SESSION["usuario"] = $usuario;
        header("Location: /GestionLaboratorio/presentacion/asistencia/asistenciaMensual.php");
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Gestión Laboratorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-card {
            max-width: 450px;
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
            margin-top: 0.5rem;
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
    <div class="card login-card">
        <div class="card-body">
            <div class="logo-placeholder">
                <h4>Gestión de Laboratorio</h4>
            </div>
            <h5 class="card-title text-center mb-4">Iniciar Sesión</h5>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" class="form-control form-control-lg" placeholder="Correo" required>
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" id="clave" name="clave" class="form-control form-control-lg" placeholder="Clave" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" name="autenticar" class="btn btn-primary btn-lg">Iniciar Sesión</button>
                </div>

                <div class="text-center mb-2">
                    <p class="mb-1">¿No tienes una cuenta?</p>
                    <a href="/GestionLaboratorio/presentacion/registroUsuario.php" class="btn btn-outline-success btn-sm">Registrarse</a>
                    <p class="mb-1">¿Olvidaste la contraseña?</p>
                    <a href="/GestionLaboratorio/presentacion/recuperacionClave.php" class="btn btn-outline-success btn-sm">Recuperar contraseña</a>
                </div>
                <?php if ($error): ?>
                    <div class="alert alert-danger mt-3" role="alert">Error de correo o clave</div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
