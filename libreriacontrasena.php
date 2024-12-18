<?php
// Verificar que el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idusuario = $_SESSION['idusuario']; // Asegúrate de que la sesión tiene el ID del usuario logueado
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Verificar que las nuevas contraseñas coinciden
    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo '<p class="text-danger">Las nuevas contraseñas no coinciden.</p>';
        exit;
    }

    // Verificar la contraseña actual
    $sql = "SELECT contraseña FROM usuarios WHERE idusuario = '$idusuario'";
    $resultado = mysqli_query($conexion, $sql);
    $usuario = mysqli_fetch_assoc($resultado);

    if (!password_verify($contrasena_actual, $usuario['contraseña'])) {
        echo '<p class="text-danger">La contraseña actual no es correcta.</p>';
        exit;
    }

    // Hashear la nueva contraseña
    $hash_contrasena = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $sql_update = "UPDATE usuarios SET contraseña = '$hash_contrasena' WHERE idusuario = '$idusuario'";
    if (mysqli_query($conexion, $sql_update)) {
        echo '<p class="text-success">Contraseña cambiada con éxito.</p>';
    } else {
        echo '<p class="text-danger">Error al cambiar la contraseña.</p>';
    }
}