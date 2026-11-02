<?php
// Ejemplo: qué información recibe PHP en cada petición HTTP.
function e(?string $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
$cabeceras = function_exists('getallheaders') ? getallheaders() : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>La petición HTTP</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 2rem auto; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 2rem; }
        td, th { border: 1px solid #ccc; padding: .4rem .6rem; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Así ve PHP tu petición</h1>

    <h2>Datos del servidor y la petición</h2>
    <table>
        <tr><th>Dato</th><th>Valor</th></tr>
        <tr><td>Método HTTP</td><td><?= e($_SERVER['REQUEST_METHOD']) ?></td></tr>
        <tr><td>URL solicitada</td><td><?= e($_SERVER['REQUEST_URI']) ?></td></tr>
        <tr><td>Protocolo</td><td><?= e($_SERVER['SERVER_PROTOCOL']) ?></td></tr>
        <tr><td>Software del servidor</td><td><?= e($_SERVER['SERVER_SOFTWARE'] ?? '') ?></td></tr>
        <tr><td>IP del cliente</td><td><?= e($_SERVER['REMOTE_ADDR']) ?></td></tr>
        <tr><td>Versión de PHP</td><td><?= e(PHP_VERSION) ?></td></tr>
        <tr><td>Sistema operativo</td><td><?= e(PHP_OS) ?></td></tr>
    </table>

    <h2>Cabeceras enviadas por tu navegador</h2>
    <table>
        <tr><th>Cabecera</th><th>Valor</th></tr>
        <?php foreach ($cabeceras as $nombre => $valor): ?>
            <tr><td><?= e($nombre) ?></td><td><?= e($valor) ?></td></tr>
        <?php endforeach; ?>
    </table>

    <p>Añade parámetros a la URL, por ejemplo <code>?curso=poo&amp;anio=2026</code>, y recarga.</p>
    <pre><?php print_r($_GET); ?></pre>
</body>
</html>
