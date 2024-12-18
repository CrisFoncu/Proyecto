<?php
include 'conexion.php';
$conexion = conectar();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = mysqli_real_escape_string($conexion, $_POST['codigo']);
    $nueva_contraseña = $_POST['nueva_contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    if ($nueva_contraseña === $confirmar_contraseña) {
        // Verificar el código y su validez
        $query = "SELECT user_id FROM restablecimiento WHERE codigo = '$codigo' AND expiracion > NOW()";
        $result = mysqli_query($conexion, $query);

        if (mysqli_num_rows($result) > 0) {
            $registro = mysqli_fetch_assoc($result);

            // Actualizar la contraseña del usuario
            $hash = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
            $query = "UPDATE usuarios SET contraseña = '$hash' WHERE idusuario = '{$registro['user_id']}'";
            mysqli_query($conexion, $query);

            // Eliminar el código de la base de datos
            $query = "DELETE FROM restablecimiento WHERE codigo = '$codigo'";
            mysqli_query($conexion, $query);

            $mensaje = "Contraseña cambiada exitosamente.";
            header("Refresh: 2, URL=index.php");
        } else {
            $mensaje = "Código inválido o expirado.";
        }
    } else {
        $mensaje = "Las contraseñas no coinciden.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
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
        <h1 class="text-center">Restablecer Contraseña</h1>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <form method="POST" action="restablecer_contrasena.php">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código de Restablecimiento</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="mb-3">
                <label for="nueva_contraseña" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="nueva_contraseña" name="nueva_contraseña" required
                    pattern="^(?=.*[A-Z])(?=.*\d(?!.*(\d)\1{2}))(?=.*[\W_]).{8,}$"
                    title="La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un número no consecutivo y un carácter especial.">
            </div>
            <div class="mb-3">
                <label for="confirmar_contraseña" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" id="confirmar_contraseña" name="confirmar_contraseña"
                    required pattern="^(?=.*[A-Z])(?=.*\d(?!.*(\d)\1{2}))(?=.*[\W_]).{8,}$"
                    title="La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un número no consecutivo y un carácter especial.">
            </div>
            <button type="submit" class="btn btn-primary w-100">Cambiar Contraseña</button>
            <a href="index.php" class="btn btn-light w-100">Volver al Inicio</a>
        </form>
    </div>
</body>

</html>