<?php
// Conectar en el login
// Determinar la etiqueta del campo de credencial según el método
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['metodo'])) {
    $metodo = $_POST['metodo'];
} else {
    echo "Método de identificación no especificado.";
    exit;
}
$campo_label = match ($metodo) {
    'email' => 'Email',
    'tarjeta' => 'Número de Tarjeta BinterMás',
    'dni_nie' => 'DNI/NIE',
    default => 'Credencial'
};

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['credencial'], $_POST['password'])) {
    $credencial = trim($_POST['credencial']);
    $password = $_POST['password'];

    // Validar el email según el método
    if ($metodo == 'email' && !filter_var($credencial, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del email es incorrecto.";
        exit;
    }
    
    // Validar el número de tarjeta según el método
    if ($metodo == 'tarjeta' && !preg_match('/^NT\d{2}\d{4}$/', $credencial)) {
        $error = "El formato del número de tarjeta es incorrecto.";
        exit;
    }


    // Validar el DNI/NIE según el método
    if ($metodo == 'dni_nie' && !preg_match('/^[XYZ]?\d{7,8}[A-Z]$/', strtoupper($credencial))) {
        $error = "El formato del DNI/NIE es incorrecto.";
        exit;
    }
    
    

    // Determinar la columna de búsqueda según el método
    $columna = match ($metodo) {
        'email' => 'email',
        'tarjeta' => 'numero_tarjeta',
        'dni_nie' => 'numero_documento',
        default => null
    };
    $conexion = conectar();
    if ($columna) {
        // Consulta a la base de datos para buscar al usuario
        $sql = "SELECT * FROM usuarios WHERE $columna = '$credencial' LIMIT 1";
        $result = mysqli_query($conexion, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $usuario = mysqli_fetch_assoc($result);

            // Verificar la contraseña
            if (password_verify($password, $usuario['contraseña'])) {
                echo "Bienvenido, " . $usuario['nombre'] . "!";

                // Aquí puedes iniciar sesión y redirigir al panel del usuario
                session_start();
                $_SESSION['idusuario'] = $usuario['idusuario'];
                header("Location: perfil.php");
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "No se encontró un usuario con la credencial proporcionada.";
        }
    } else {
        $error = "Método de identificación inválido.";
        header("Refresh: 2; URL=index.php");
    }
}
?>