<?php
declare(strict_types=1);

$opciones = ["php" => "PHP", "js" => "JavaScript", "python" => "Python", "java" => "Java"];
$archivo = __DIR__ . "/datos/votos.json";

// Votos guardados, o todos a cero si es la primera vez
$votos = array_fill_keys(array_keys($opciones), 0);
if (file_exists($archivo)) {
    $votos = json_decode(file_get_contents($archivo), true) ?? $votos;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $voto = $_POST["lenguaje"] ?? "";
    if (array_key_exists($voto, $opciones)) {
        $votos[$voto]++;
        file_put_contents($archivo, json_encode($votos), LOCK_EX);
    }
    header("Location: ej02-encuesta.php");   // Post/Redirect/Get
    exit;
}

$total = array_sum($votos);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Encuesta</title></head>
<body>
<h1>¿Qué lenguaje te gusta más?</h1>
<form method="post">
    <?php foreach ($opciones as $clave => $nombre): ?>
        <label><input type="radio" name="lenguaje" value="<?= $clave ?>"> <?= $nombre ?></label><br>
    <?php endforeach; ?>
    <button type="submit">Votar</button>
</form>

<h2>Resultados (<?= $total ?> votos)</h2>
<?php foreach ($opciones as $clave => $nombre): ?>
    <?php $porcentaje = $total > 0 ? round($votos[$clave] * 100 / $total) : 0; ?>
    <p><?= $nombre ?>: <?= $votos[$clave] ?> (<?= $porcentaje ?> %)
        <br><span style="display:inline-block; height:12px; background:#4f7cff; width:<?= $porcentaje * 3 ?>px"></span>
    </p>
<?php endforeach; ?>
</body>
</html>
