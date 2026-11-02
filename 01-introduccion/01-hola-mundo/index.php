<?php
// Todo lo que está entre <?php y ?> lo ejecuta el SERVIDOR.
// El navegador nunca ve este código, solo recibe el HTML resultante.
$nombre = "mundo";
$ahora  = date('d/m/Y H:i:s');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hola mundo con PHP</title>
</head>
<body>
    <h1>¡Hola, <?= $nombre ?>!</h1>
    <p>Esta página se generó en el servidor el <strong><?= $ahora ?></strong>.</p>
    <p>Recarga la página: la hora cambia porque PHP se ejecuta en cada petición.</p>

    <h2>Mezclando HTML y PHP</h2>
    <ul>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <li>Elemento número <?= $i ?></li>
        <?php endfor; ?>
    </ul>

    <p><em>Prueba: en el navegador pulsa Ctrl+U (ver código fuente). ¿Ves el PHP?</em></p>
</body>
</html>
