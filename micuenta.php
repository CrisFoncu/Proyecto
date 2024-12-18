<?php
session_start();
include 'conexion.php';
include 'libreriaperfil.php';
include 'libreriacontrasena.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Binter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            margin-top: 5px;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            width: 100%;
        }

        .card-body {
            background-color:
                <?php echo $color_tarjeta; ?>
            ;
            color: #ffffff;
        }

        .box {
            background-color:
                <?php echo $color_tarjeta; ?>
            ;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .menu {
            margin: 20px 0;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        .btn-success {
            background-color: #ffffff;
            border: none;
            color: black
        }

        .btn-success:hover {
            background-color: #f1f1f1;
            color: black
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


    <div class="container">
        <div class="header">
            <h3>Bienvenid@, <?php echo $usuario['nombre']; ?></h3>
            <p>Tarjeta <?php echo htmlspecialchars($usuario['tarjeta_tipo']); ?>:
                <?php echo ucfirst($usuario['numero_tarjeta'], ); ?>
            </p>
        </div><br>

        <div class="card mx-auto" style="width: 18rem;">
            <div class="text-center mt-4">
                <img src="<?php echo isset($usuario['foto_perfil']) && !empty($usuario['foto_perfil']) ? './fotos/' . htmlspecialchars($usuario['foto_perfil']) : './fotos/default_avatar.png'; ?>"
                    alt="Avatar" class="avatar" style="width: 150px; height: 150px; border-radius: 50%;">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title"><?php echo $usuario['nombre'] . ' ' . $usuario['primer_apellido']; ?>
                </h5>
                <p class="card-text">
                    <strong>Email:</strong> <?php echo $usuario['email']; ?><br>
                    <strong>Teléfono:</strong> <?php echo $usuario['telefono']; ?><br>
                    <strong>Fecha Nacimiento:</strong> <?php echo $usuario['fecha_nacimiento']; ?><br>
                    <strong>Dni:</strong> <?php echo $usuario['numero_documento']; ?><br>
                    <strong>Documento:</strong> <?php echo $usuario['numero_documento']; ?><br>
                    <strong>Isla:</strong> <?php echo $usuario['isla']; ?><br>
                    <strong>Municipio:</strong> <?php echo $usuario['municipio']; ?><br>
                    <strong>Puntos:</strong> <?php echo $usuario['puntos']; ?><br>
                </p>
                <form action="perfil.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="foto_perfil" class="form-label">Subir Foto</label>
                        <input type="file" name="foto_perfil" id="foto_perfil" class="form-control"
                            accept="image/jpeg, image/png">
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar Avatar</button>
                </form><br>
                <a href="cambiarcontrasena.php" class="btn btn-light">Cambiar Contraseña</a>
            </div>

        </div>
    </div>
    </div><br>
    <footer class="bg-white text-center py-4">
        <p id="fot">&copy; 2024 Proyecto Binter. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>