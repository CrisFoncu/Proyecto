<?php
session_start();
include 'conexion.php';
include 'libreriabuscar.php';
include 'libreriaperfil.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
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

        body {
            background-color: #f1f1f1;
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

        #fot {
            color: #1a7b32;
        }

        select {
            color: #1a7b32;
            background-color: white;
        }

        /* Estilo para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 20px;
            border-radius: 10px;
            /* Bordes redondeados */
            overflow: hidden;
            /* Para que los bordes redondeados se vean bien */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Sombra suave alrededor de la tabla */
            background-color: #ffffff;
            /* Fondo blanco para la tabla */
        }

        /* Estilo para las celdas (th, td) */
        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            transition: background-color 0.3s;
            /* Transición suave en el cambio de color de fondo */
        }

        th {
            background-color: #0f6b81;
            /* Color de fondo para los encabezados */
            color: green;
            /* Texto blanco para los encabezados */
            font-weight: bold;
            /* Negrita en los encabezados */
            text-transform: uppercase;
            /* Mayúsculas en los encabezados */
            letter-spacing: 1px;
            /* Espaciado entre letras */
            padding-top: 16px;
            /* Espaciado superior */
            padding-bottom: 16px;
            /* Espaciado inferior */
        }

        /* Estilo para las filas alternas (tr) */
        tr:nth-child(even) {
            background-color: #71d17d;
            /* Fondo verde claro para filas pares */
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
            /* Fondo blanco para filas impares */
        }

        tr:hover {
            background-color: #e0f7fa;
            /* Color de fondo al pasar el ratón */
            transform: translateY(-2px);
            /* Sombra al pasar el ratón */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra adicional al pasar el ratón */
        }

        /* Estilo para las celdas de datos (td) */
        td {
            background-color: #ffffff;
            /* Fondo blanco para las celdas */
            color: #333;
            /* Texto en negro para una mejor legibilidad */
            border-left: 1px solid #e0e0e0;
            /* Borde izquierdo */
            border-right: 1px solid #e0e0e0;
            /* Borde derecho */
        }

        /* Estilo de pie de tabla */
        tfoot {
            background-color: #007c91;
            color: white;
            font-weight: bold;
        }

        tfoot td {
            text-align: right;
            padding: 10px 15px;
            border-top: 2px solid #e0e0e0;
            /* Borde superior para el pie */
        }

        /* Estilo para el botón en las celdas */
        button {
            background-color: #0f6b81;
            /* Color de fondo para el botón */
            color: white;
            /* Texto blanco en el botón */
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            /* Bordes redondeados */
            cursor: pointer;
            transition: background-color 0.3s;
            /* Transición suave para el color de fondo */
        }

        button:hover {
            background-color: #007c91;
            /* Cambio de color en hover */
        }

        /* Estilo para las celdas con bordes redondeados */
        th:first-child,
        td:first-child {
            border-left: none;
        }

        th:last-child,
        td:last-child {
            border-right: none;
        }

        .btn {
            background-color:
                <?php echo $color_tarjeta; ?>
            ;
            color: #ffffff;
            border-radius: 10px 10px 10px 10px;
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
    <div class="container mt-5">
        <h1>Vuelos Disponibles</h1>

        <!-- Formulario de búsqueda -->

        <form method="POST" action="">
            <label for="filtro_columna">Buscar por:</label>
            <select name="filtro_columna" id="filtro_columna">
                <option value="">Seleccione una opción</option>
                <option value="NumVuelo" <?= $filtro_columna === 'NumVuelo' ? 'selected' : '' ?>>Número de Vuelo</option>
                <option value="origen" <?= $filtro_columna === 'origen' ? 'selected' : '' ?>>Origen</option>
                <option value="destino" <?= $filtro_columna === 'destino' ? 'selected' : '' ?>>Destino</option>
                <option value="fechaHora" <?= $filtro_columna === 'fechaHora' ? 'selected' : '' ?>>Fecha y Hora</option>
            </select>

            <input type="text" name="filtro_valor" id="filtro_valor" value="<?= htmlspecialchars($filtro_valor) ?>"
                placeholder="Ingrese término de búsqueda">
            <button type="submit">Buscar</button>
            <a href="misreservas.php" class="btn btn-light">Volver a Reservas</a>
        </form>

        <!-- Lista de vuelos -->
        <div class="col-6 text-center">
            <?php if ($vuelos && mysqli_num_rows($vuelos) > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Número de Vuelo</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($vuelo = mysqli_fetch_assoc($vuelos)): ?>
                            <tr>
                                <td><?= htmlspecialchars($vuelo['NumVuelo']) ?></td>
                                <td><?= htmlspecialchars($vuelo['origen']) ?></td>
                                <td><?= htmlspecialchars($vuelo['destino']) ?></td>
                                <td><?= htmlspecialchars($vuelo['fechaHora']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No se encontraron vuelos disponibles.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<footer class="bg-white text-center py-4">
    <p id="fot">&copy; 2024 Proyecto Binter. Todos los derechos reservados.</p>
</footer>

</html>