<?php
// Formulario con método GET: los datos viajan en la URL.
function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

$buscar = isset($_GET['q']) ? trim($_GET['q']) : '';

$lenguajes = ['PHP', 'JavaScript', 'Python', 'Java', 'C#', 'Go', 'Rust', 'TypeScript', 'Kotlin', 'Swift'];
$resultados = [];
if ($buscar !== '') {
    foreach ($lenguajes as $l) {
        if (stripos($l, $buscar) !== false) {
            $resultados[] = $l;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario GET</title>
</head>
<body>
    <h1>Buscador (método GET)</h1>

    <form action="index.php" method="get">
        <label for="q">Buscar lenguaje:</label>
        <input type="text" id="q" name="q" value="<?= e($buscar) ?>">
        <button type="submit">Buscar</button>
    </form>

    <?php if ($buscar !== ''): ?>
        <h2>Resultados para «<?= e($buscar) ?>»</h2>
        <?php if ($resultados): ?>
            <ul>
                <?php foreach ($resultados as $r): ?>
                    <li><?= e($r) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se ha encontrado nada.</p>
        <?php endif; ?>
    <?php endif; ?>

    <hr>
    <p><strong>Fíjate en la barra de direcciones:</strong> los datos aparecen en la URL
    (<code>?q=...</code>). Por eso GET sirve para búsquedas y filtros (se pueden
    compartir y guardar en favoritos) pero <em>nunca</em> para contraseñas.</p>
</body>
</html>
