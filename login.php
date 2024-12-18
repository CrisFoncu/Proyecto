<?php
include 'conexion.php';
include 'librerialogin.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Binter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            /* Asegura que ocupen toda la altura de la ventana */
            margin: 0;
            /* Elimina márgenes por defecto */
        }

        body {
            display: flex;
            flex-direction: column;
            /* Ordena los elementos verticalmente */
            min-height: 100vh;
            /* Garantiza que ocupe toda la altura visible */
        }

        .container {
            flex: 1;
            /* Hace que el contenido ocupe el espacio restante */
        }

        .display-1 {
            color: #1a7b32;
        }

        .form-container {
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #00843d;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .btn-success {
            background-color: #00843d;
            border: none;
        }

        .btn-success:hover {
            background-color: #006b30;
        }

        a.text-success {
            color: #00843d;
        }

        a.text-success:hover {
            color: #006b30;
            text-decoration: none;
        }

        #fot {
            color: #1a7b32;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-success">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="https://www.bintercanarias.com/assets/icons/Logo.svg" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-white text-center py-5">
        <div class="container">
            <h1 class="display-1">BinterMás</h1>

        </div>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <div class="header">
                        <h5>Login - <?php echo ucfirst($metodo); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="credencial" class="form-label"><?php echo $campo_label; ?></label>
                                <input type="text" id="credencial" name="credencial" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <input type="hidden" name="metodo" value="<?php echo htmlspecialchars($metodo); ?>">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="recuperar_contrasena.php" class="text-success">¿Has olvidado la contraseña?</a><br>
                            <a href="index.php" class="text-success">Cambiar metodo de identificación</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-white text-success text-center py-4">
        <p id="fot">&copy; 2024 Proyecto Binter. Todos los derechos reservados.</p>
    </footer>
</body>

</html>