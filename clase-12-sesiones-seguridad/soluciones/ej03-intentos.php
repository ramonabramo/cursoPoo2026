<?php
declare(strict_types=1);

session_start();

const MAX_INTENTOS = 3;
const BLOQUEO_SEGUNDOS = 60;

// Usuario de prueba: luis / secreto123
$hashGuardado = password_hash("secreto123", PASSWORD_DEFAULT);   // en la vida real vendría de la BD

$_SESSION["intentos"] ??= 0;
$_SESSION["bloqueadoHasta"] ??= 0;
$mensaje = "";

$bloqueado = time() < $_SESSION["bloqueadoHasta"];

if ($_SERVER["REQUEST_METHOD"] === "POST" && !$bloqueado) {
    $usuario = $_POST["usuario"] ?? "";
    $clave = $_POST["clave"] ?? "";

    if ($usuario === "luis" && password_verify($clave, $hashGuardado)) {
        $_SESSION["intentos"] = 0;
        $mensaje = "¡Bienvenido, Luis!";
    } else {
        $_SESSION["intentos"]++;
        $restantes = MAX_INTENTOS - $_SESSION["intentos"];
        if ($restantes <= 0) {
            $_SESSION["bloqueadoHasta"] = time() + BLOQUEO_SEGUNDOS;
            $_SESSION["intentos"] = 0;
            $bloqueado = true;
        } else {
            $mensaje = "Datos incorrectos. Intentos restantes: {$restantes}.";
        }
    }
}

if ($bloqueado) {
    $espera = $_SESSION["bloqueadoHasta"] - time();
    $mensaje = "Demasiados intentos. Espera {$espera} segundos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Login con intentos</title></head>
<body>
<h1>Acceso</h1>
<?php if ($mensaje !== ""): ?><p><strong><?= htmlspecialchars($mensaje) ?></strong></p><?php endif; ?>
<?php if (!$bloqueado): ?>
    <form method="post">
        <input name="usuario" placeholder="Usuario">
        <input type="password" name="clave" placeholder="Contraseña">
        <button>Entrar</button>
    </form>
<?php endif; ?>
</body>
</html>
