<!DOCTYPE html>
<?php
include 'conexion.php';
?>
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

        .column {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .column.identificacion {
            background-color: #ffffff;
            color: #1a7b32;
        }

        .column.registro {
            background-color: #1a7b32;
            color: #ffffff;
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 30px;
        }

        form {
            width: 100%;
        }

        select,
        input[type="submit"] {
            width: 80%;
            margin: 10px 0;
            padding: 10px;
            border: 2px solid #1a7b32;
            border-radius: 5px;
            font-size: 16px;
        }

        select {
            color: #1a7b32;
            background-color: white;
        }

        input[type="submit"] {
            color: white;
            background-color: #1a7b32;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #145823;
        }

        .registro-btn {
            background-color: #ffffff;
            color: #1a7b32;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        .registro-btn:hover {
            text-decoration: underline;
        }

        .display-1 {
            color: #1a7b32;
        }

        .nav-link {
            background-color: #ffffff;
            color: #1a7b32;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        .nav-link:hover {
            text-decoration: underline;
            color: #1a7b32;
        }

        #fot {
            color:
                <?php echo $color_tarjeta; ?>
            ;

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
        </div>
    </nav>

    <header class="bg-white text-center py-5">
        <div class="container">
            <h1 class="display-1">BinterMás</h1>

        </div>
    </header>
    <div class="container">
        <div class="row">
            <!-- Identificación -->
            <div class="col-6">
                <div class="column identificacion">
                    <h2>Identificación</h2>
                    <label for="metodo" class="form-label">Método de Identificación</label>
                    <form action="login.php" method="POST">
                        <select id="metodo" name="metodo" class="form-select" required>
                            <option value="email">EMAIL</option>
                            <option value="tarjeta">Tarjeta BinterMas</option>
                            <option value="dni_nie">DNI / NIE</option>
                        </select>
                        <input type="submit" value="Login">
                    </form>
                </div>
            </div>

            <!-- Registro -->
            <div class="col-6">
                <div class="column registro">
                    <h2>¿Aún no tienes cuenta?</h2>
                    <p>Regístrate para disfrutar de todas las ventajas:</p>
                    <ul style="text-align: left;">
                        <li>Acceso a promociones exclusivas.</li>
                        <li>Consulta y canje de puntos BinterMas.</li>
                        <li>Soporte personalizado.</li>
                    </ul>
                    <a class="nav-link" href="registro.php">Registrarme</a>
                </div>
            </div>
        </div>
    </div>


    <footer class="bg-white text-success text-center py-4">
        <p id="fot">&copy; 2024 Proyecto Binter. Todos los derechos reservados.</p>
    </footer>

</body>

</html>