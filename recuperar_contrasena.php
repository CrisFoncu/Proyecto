<?php
include 'conexion.php';
$conexion = conectar();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);

    // Verificar si el correo existe en la base de datos
    $query = "SELECT idusuario FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        // Generar un código de restablecimiento
        $codigo = bin2hex(random_bytes(4));
        $expiracion = date("Y-m-d H:i:s", strtotime("+15 minutes"));

        // Guardar el código en la base de datos
        $query = "INSERT INTO restablecimiento (user_id, codigo, expiracion) VALUES ('{$usuario['idusuario']}', '$codigo', '$expiracion')";
        mysqli_query($conexion, $query);

        // Enviar el correo con el código (esto es un ejemplo)
        mail($email, "Código de Restablecimiento", "Tu código de restablecimiento es: $codigo", "From: no-reply@bintermas.com");

        $mensaje = "Se ha enviado un correo con el código de restablecimiento.";
        header("Refresh: 2; URL=restablecer_contrasena.php");
    } else {
        $mensaje = "El correo no está registrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn {
            background-color: #1a7b32;
            border-color: #1a7b32;
            margin-bottom: 1px;
            color: #ffffff;
        }
        .btn:hover {
            background-color: #ffffff;
            border-color: #1a7b32;
            color: #1a7b32;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Recuperar Contraseña</h1>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <form method="POST" action="recuperar_contrasena.php">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar Código</button>
            <a href="index.php" class="btn btn-light w-100">Volver al Inicio</a>
        </form>
    </div>
</body>

</html>