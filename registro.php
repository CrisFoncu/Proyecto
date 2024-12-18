<?php
include 'conexion.php'; // Conexión a la base de datos
include 'libreriaregistro.php';

// Validar si el formulario ha sido enviado

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Binter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h2 {
            color: #1a7b32;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #1a7b32;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 2px solid #1a7b32;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #1a7b32;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #145823;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .display-1 {
            color: #1a7b32;
        }

        .nav-link {
            background-color: #1a7b32;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 18px;
            text-align: center;
            font-weight: 500;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        .nav-link:hover {
            background-color: #ffffff;
            color: #1a7b32;
            border: 1px solid #1a7b32;
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
    <header class="bg-white text-success text-center py-5">
        <div class="container">
            <h1 class="display-1">Registro</h1>
        </div>
    </header>
    <div class="container">
        <h2>Formulario de Registro</h2>
        <?php
        if (!empty($errores)) {
            echo '<div class="error">';
            foreach ($errores as $error) {
                echo "<p>$error</p>";
            }
            echo '</div>';
        }
        ?>
        <div class="row">
            <div class="col-6">
                <form action="registro.php" method="POST">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>"
                        required>
                    <label for="primer_apellido">Primer Apellido:</label>
                    <input type="text" id="primer_apellido" name="primer_apellido"
                        value="<?php echo isset($primer_apellido) ? $primer_apellido : ''; ?>" required>
                    <label for="segundo_apellido">Segundo Apellido:</label>
                    <input type="text" id="segundo_apellido" name="segundo_apellido"
                        value="<?php echo isset($segundo_apellido) ? $segundo_apellido : ''; ?>">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                        value="<?php echo isset($fecha_nacimiento) ? $fecha_nacimiento : ''; ?>" required
                        min="<?php echo date('Y-m-d', strtotime('-100 years')); ?>"
                        max="<?php echo date('Y-m-d', strtotime('-16 years')); ?>">
                    <label for="nacionalidad">Nacionalidad:</label>
                    <input type="text" id="nacionalidad" name="nacionalidad"
                        value="<?php echo isset($nacionalidad) ? $nacionalidad : ''; ?>" required>
                    <label for="residente">¿Es residente?</label>
                    <select id="residente" name="residente" required>
                        <option value="Si" <?php echo (isset($residente) && $residente == 'Si') ? 'selected' : ''; ?>>Sí
                        </option>
                        <option value="No" <?php echo (isset($residente) && $residente == 'No') ? 'selected' : ''; ?>>No
                        </option>
                    </select>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono"
                        value="<?php echo isset($telefono) ? $telefono : ''; ?>" required>
            </div>
            <div class="col-6">
                <label for="isla">Selecciona una Isla:</label>
                <select id="isla" name="isla" required>
                    <option value="">Selecciona una isla</option>
                    <option value="Tenerife">Tenerife</option>
                    <option value="Gran Canaria">Gran Canaria</option>
                    <option value="Lanzarote">Lanzarote</option>
                    <option value="Fuerteventura">Fuerteventura</option>
                    <option value="La Palma">La Palma</option>
                    <option value="La Gomera">La Gomera</option>
                    <option value="El Hierro">El Hierro</option>
                </select>
                <label for="municipio">Selecciona un Municipio:</label>
                <select id="municipio" name="municipio" required>
                    <optgroup label="Tenerife">
                        <option value="Santa Cruz de Tenerife">Santa Cruz de Tenerife</option>
                        <option value="La Laguna">La Laguna</option>
                        <option value="Arona">Arona</option>
                    </optgroup>
                    <optgroup label="Gran Canaria">
                        <option value="Las Palmas de Gran Canaria">Las Palmas de Gran Canaria</option>
                        <option value="Telde">Telde</option>
                        <option value="San Bartolomé de Tirajana">San Bartolomé de Tirajana</option>
                    </optgroup>
                    <optgroup label="Lanzarote">
                        <option value="Arrecife">Arrecife</option>
                        <option value="San Bartolomé">San Bartolomé</option>
                        <option value="Teguise">Teguise</option>
                    </optgroup>
                    <optgroup label="Fuerteventura">
                        <option value="Puerto del Rosario">Puerto del Rosario</option>
                        <option value="Antigua">Antigua</option>
                        <option value="La Oliva">La Oliva</option>
                    </optgroup>
                    <optgroup label="La Palma">
                        <option value="Santa Cruz de La Palma">Santa Cruz de La Palma</option>
                        <option value="Los Llanos de Aridane">Los Llanos de Aridane</option>
                        <option value="Breña Alta">Breña Alta</option>
                    </optgroup>
                    <optgroup label="La Gomera">
                        <option value="San Sebastián de La Gomera">San Sebastián de La Gomera</option>
                        <option value="Valle Gran Rey">Valle Gran Rey</option>
                        <option value="Alajeró">Alajeró</option>
                    </optgroup>
                    <optgroup label="El Hierro">
                        <option value="Valverde">Valverde</option>
                        <option value="La Frontera">La Frontera</option>
                        <option value="El Pinar">El Pinar</option>
                    </optgroup>
                </select>
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                <label for="documento_tipo">Tipo de Documento:</label>
                <select id="documento_tipo" name="documento_tipo" required>
                    <option value="DNI" <?php echo (isset($documento_tipo) && $documento_tipo == 'DNI') ? 'selected' : ''; ?>>DNI</option>
                    <option value="NIE" <?php echo (isset($documento_tipo) && $documento_tipo == 'NIE') ? 'selected' : ''; ?>>NIE</option>
                </select>

                <label for="numero_documento">Número de Documento:</label>
                <input type="text" id="numero_documento" name="numero_documento"
                    value="<?php echo isset($numero_documento) ? $numero_documento : ''; ?>" required
                    pattern="^(([X-Zx-z]\d{7}[A-Za-z])|(\d{8}[A-Za-z]))$">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required
                    pattern="^(?=.*[A-Z])(?=.*\d(?!.*(\d)\1{2}))(?=.*[\W_]).{8,}$"
                    title="La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un número no consecutivo y un carácter especial.">
                <div class="col">
                    <br><input type="submit" value="Registrar">
                </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-white text-center py-4">
        <p id="fot">&copy; 2024 Proyecto Binter. Todos los derechos reservados.</p>
    </footer>
</body>

</html>