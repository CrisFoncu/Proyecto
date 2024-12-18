<?php
// Registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre = trim($_POST['nombre']);
    $primer_apellido = trim($_POST['primer_apellido']);
    $segundo_apellido = trim($_POST['segundo_apellido']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $nacionalidad = $_POST['nacionalidad'];
    $residente = $_POST['residente'];
    $isla = $_POST['isla'];
    $municipio = $_POST['municipio'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $documento_tipo = $_POST['documento_tipo'];
    $numero_documento = $_POST['numero_documento'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Cifrado de la contraseña

    // Validaciones
    $conexion = conectar();
    $errores = [];

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
        $errores[] = "El nombre solo puede contener letras y espacios.";
    }
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $primer_apellido)) {
        $errores[] = "El primer apellido solo puede contener letras y espacios.";
    }
    if (!empty($segundo_apellido) && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $segundo_apellido)) {
        $errores[] = "El segundo apellido solo puede contener letras y espacios.";
    }


    if ($documento_tipo == "DNI" && !preg_match("/^\d{8}[A-Z]$/", $numero_documento)) {
        $errores[] = "El DNI debe contener 8 dígitos seguidos de una letra mayúscula.";
    }
    if ($documento_tipo == "NIE" && !preg_match("/^[XYZ]\d{7}[A-Z]$/", $numero_documento)) {
        $errores[] = "El NIE debe comenzar con X, Y o Z, seguido de 7 dígitos y una letra mayúscula.";
    }

    if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])(?=.*(?!.*123|234|345|456)).{8,}$/", $_POST['contraseña'])) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un número no correlativo y un carácter especial.";
    }


    if (empty($nombre) || empty($primer_apellido) || empty($fecha_nacimiento) || empty($nacionalidad) || empty($email) || empty($contraseña)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    // Verificar si el email ya está registrado
    $sql_check_email = "SELECT idusuario FROM usuarios WHERE email = '$email'";
    $result_check_email = mysqli_query($conexion, $sql_check_email);

    if (mysqli_num_rows($result_check_email) > 0) {
        $errores[] = "El correo electrónico ya está registrado.";
    }

    // Verificar si el número de documento ya está registrado
    $sql_check_doc = "SELECT idusuario FROM usuarios WHERE numero_documento = '$numero_documento'";
    $result_check_doc = mysqli_query($conexion, $sql_check_doc);
    if (mysqli_num_rows($result_check_doc) > 0) {
        $errores[] = "El número de documento ya está registrado.";
    }


    // Si no hay errores, insertar el nuevo usuario en la base de datos
    if (empty($errores)) {
        // Determinar el tipo de tarjeta y los puntos
        $tarjeta_tipo = 'Verde'; // Asignación por defecto
        $puntos = 100; // Puntos por defecto para tarjeta verde

        // Generar el número de tarjeta según el tipo
        $numero_tarjeta = '';
        if ($tarjeta_tipo == 'Verde') {
            $numero_tarjeta = 'NT10' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        } elseif ($tarjeta_tipo == 'Plata') {
            $numero_tarjeta = 'NT20' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $puntos = 2500; // Puntos para tarjeta plata
        } elseif ($tarjeta_tipo == 'Oro') {
            $numero_tarjeta = 'NT30' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $puntos = 8000; // Puntos para tarjeta oro
        }

        // Insertar el nuevo usuario con el número de tarjeta generado
        $sql = "INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, fecha_nacimiento, nacionalidad, residente, isla, municipio, telefono, email, documento_tipo, numero_documento, contraseña, tarjeta_tipo, puntos, numero_tarjeta) 
            VALUES ('$nombre', '$primer_apellido', '$segundo_apellido', '$fecha_nacimiento', '$nacionalidad', '$residente', '$isla', '$municipio', '$telefono', '$email', '$documento_tipo', '$numero_documento', '$contraseña', '$tarjeta_tipo', $puntos, '$numero_tarjeta')";

        if (mysqli_query($conexion, $sql)) {
            echo "Usuario registrado exitosamente.";
            header("Location:index.php");
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($conexion);
        }
    }
}
?>