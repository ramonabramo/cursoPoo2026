<?php
declare(strict_types=1);

// Si el usuario elige un tema, lo guardamos en una cookie durante 30 días
$temas = ["claro", "oscuro"];
if (in_array($_GET["tema"] ?? "", $temas, true)) {
    setcookie("tema", $_GET["tema"], [
        "expires" => time() + 60 * 60 * 24 * 30,   // dentro de 30 días
        "path" => "/",
        "httponly" => true,                        // JavaScript no puede leerla
        "samesite" => "Lax",
    ]);
    header("Location: 02-cookie-tema.php");   // recargamos para que la cookie ya llegue
    exit;
}

// Leer la cookie (si no existe, tema claro)
$tema = $_COOKIE["tema"] ?? "claro";
$fondo = $tema === "oscuro" ? "#1e1e1e" : "#ffffff";
$texto = $tema === "oscuro" ? "#eeeeee" : "#222222";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tema</title>
    <style>
        body { background: <?= $fondo ?>; color: <?= $texto ?>; font-family: sans-serif; padding: 2rem; }
        a { color: #4f7cff; }
    </style>
</head>
<body>
    <h1>Tema actual: <?= $tema ?></h1>
    <p><a href="?tema=claro">Tema claro</a> · <a href="?tema=oscuro">Tema oscuro</a></p>
    <p>Cerrad el navegador y volved a abrir la página: el tema se recuerda.</p>
</body>
</html>
