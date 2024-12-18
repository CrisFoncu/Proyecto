<!DOCTYPE html>
<?php
session_start();
include 'conexion.php';
include 'libreriaentretenimiento.php';
include 'libreriaperfil.php';
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

        .secuencia {
            font-size: 24px;
            margin: 20px 0;
            text-align: center;
            color:
                <?php echo $color_tarjeta; ?>
            ;
            animation: desaparecer 10s forwards;
            -webkit-animation: desaparecer 10s forwards;
        }

        @keyframes desaparecer {
            0% {
                opacity: 1;
                display: block;
            }

            99% {
                opacity: 0;
                display: block;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }

        .resploca {
            justify-content: center;
            align-items: center;
        }

        /* Estilo para la barra de navegación */
        .navbar-success {
            background-color: #ffffff;
            /* Fondo blanco */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            max-height: 40px;
        }

        .navbar-nav .nav-link {
            color:
                <?php echo $color_tarjeta; ?>
            ;
            /* Texto verde */
            font-weight: 500;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .dropdown-menu {
            color: #ffffff;
            /* Texto blanco en hover */
            background-color:
                <?php echo $color_tarjeta; ?>
            ;
            /* Fondo verde en hover */
            border-radius: 5px;
        }

        .navbar-toggler {
            border-color: rgba(0, 132, 61, 0.5);
            /* Verde translúcido */
        }

        .navbar-toggler-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns%3D%27http%3A//www.w3.org/2000/svg%27 viewBox%3D%270 0 30 30%27%3E%3Cpath stroke%3D%27rgba%280%2C132%2C61%2C0.5%29%27 stroke-width%3D%272%27 stroke-linecap%3D%27round%27 stroke-miterlimit%3D%2710%27 d%3D%27M4 7h22M4 15h22M4 23h22%27/%3E%3C/svg%3E');
        }

        /* Estilo para los menús desplegables */
        .dropdown-menu {
            background-color: #00843d;
            /* Fondo verde para los dropdowns */
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra ligera */
        }

        .dropdown-item {
            color: #ffffff;
            /* Texto blanco para los elementos del dropdown */
            font-weight: 500;
            padding: 10px 15px;
        }

        .dropdown-item:hover {
            background-color: #ffffff;
            /* Fondo blanco al pasar el mouse */
            color:
                <?php echo $color_tarjeta; ?>
            ;
            /* Texto verde en hover */
        }

        /* Estilo responsivo */
        @media (max-width: 991px) {
            .navbar-collapse {
                background-color: #ffffff;
                /* Fondo blanco en modo colapsado */
                border-radius: 0 0 10px 10px;
            }

            .nav-link {
                color: #00843d;
                /* Asegurar texto verde en dispositivos móviles */
            }
        }

        body {
            background-color: #f1f1f1;
        }

        .header {
            background-color:
                <?php echo $color_tarjeta; ?>
            ;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            width: 100%;
        }

        .menu {
            margin: 20px 0;
        }

        .card {
            background-color:
                <?php echo $color_tarjeta; ?>
            ;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid
                <?php echo $color_tarjeta; ?>
            ;
            color: #ffffff;
        }

        .avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        h2,
        label {
            color:
                <?php echo $color_tarjeta; ?>
            ;
        }

        button {
            background-color:
                <?php echo $color_tarjeta; ?>
            ;
            color: #ffffff;
            border-radius: 10px 10px 10px 10px;
            border-color:
                <?php echo $color_tarjeta; ?>
            ;
        }

        p {
            color:
                <?php echo $color_tarjeta; ?>
            ;
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
                <img src="https://www.bintercanarias.com/assets/icons/Logo.svg" alt="Logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Menú "Perfil" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="perfil.php" id="perfilDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Perfil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="perfilDropdown">
                            <li><a class="dropdown-item" href="perfil.php">Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="micuenta.php">Mi Cuenta</a></li>
                            <li><a class="dropdown-item" href="misreservas.php">Mis Reservas</a></li>
                            <li><a class="dropdown-item" href="opcionlibre.php">Opción Libre</a></li>
                            <li><a class="dropdown-item" href="utilidades.php">Utilidades de Viaje</a></li>
                            <li><a class="dropdown-item" href="otras.php">Otras Utilidades</a></li>
                        </ul>
                    </li>
                    <!-- Opción "Cerrar Sesión" -->
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5 d-flex justify-content-center">
        <div class="col-md-6 border p-4 rounded shadow">
            <h2 class="text-center">Simon Dice - Localidades Canarias</h2>

            <?php if (!isset($_POST['respuesta'])): ?>
                <!-- muestra la secuencia -->
                <div class="secuencia">
                    Memoriza estas localidades:<br><br>
                    <?php echo implode('<br>', $mostrarlocalidades); ?>
                </div>

                <!-- formulario para la respuesta -->
                <form class="resploca text-center" method="post" action="">
                    <input type="hidden" name="secuencia" value="<?php echo $secuencia; ?>">
                    <label>Escribe las localidades en orden (separadas por comas):</label><br>
                    <br><input type="text" name="respuesta">
                    <button type="submit">Comprobar</button>
                </form>

            <?php else: ?>
                <!-- muestra el resultado -->
                <div class="mensaje">
                    <?php echo $mensaje; ?>
                </div>

                <!-- Botón para nueva partida -->
                <form method="post" action="">
                    <button type="submit">Nueva Partida</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-4 text-center">
        <p>Tu puntuación actual es: <?php echo $usuario['puntos']; ?> puntos.</p>
    </div>




    <footer class="bg-white text-center py-4">
        <p id="fot">&copy; 2024 Proyecto Binter. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>