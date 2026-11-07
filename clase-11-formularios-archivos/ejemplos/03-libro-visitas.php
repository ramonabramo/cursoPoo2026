<?php
declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
}

date_default_timezone_set("Europe/Madrid");

$archivo = __DIR__ . "/datos/visitas.json";

// Leer las visitas guardadas (si el archivo existe)
$visitas = [];
if (file_exists($archivo)) {
    $visitas = json_decode(file_get_contents($archivo), true) ?? [];
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $texto = trim($_POST["texto"] ?? "");

    if ($nombre === "" || $texto === "") {
        $error = "Rellena los dos campos.";
    } else {
        // Añadir la nueva visita al principio
        array_unshift($visitas, [
            "nombre" => $nombre,
            "texto" => $texto,
            "fecha" => date("d/m/Y H:i"),
        ]);

        // Guardar todo el array como JSON
        file_put_contents(
            $archivo,
            json_encode($visitas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            LOCK_EX
        );

        // Post/Redirect/Get: redirigimos para que F5 no vuelva a enviar el formulario
        header("Location: 03-libro-visitas.php?ok=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libro de visitas</title>
</head>
<body>
    <h1>Libro de visitas</h1>

    <?php if (isset($_GET["ok"])): ?>
        <p style="color: green">¡Gracias por firmar!</p>
    <?php endif; ?>

    <?php if ($error !== ""): ?>
        <p style="color: red"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="nombre" placeholder="Tu nombre">
        <input type="text" name="texto" placeholder="Tu mensaje">
        <button type="submit">Firmar</button>
    </form>

    <h2>Firmas: <?= count($visitas) ?></h2>
    <?php foreach ($visitas as $visita): ?>
        <p>
            <strong><?= e($visita["nombre"]) ?></strong>
            <small>(<?= e($visita["fecha"]) ?>)</small><br>
            <?= e($visita["texto"]) ?>
        </p>
    <?php endforeach; ?>
</body>
</html>
