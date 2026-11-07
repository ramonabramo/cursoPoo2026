<?php
declare(strict_types=1);

$carpeta = __DIR__ . "/fotos";
$tipos = ["image/jpeg" => "jpg", "image/png" => "png", "image/webp" => "webp"];
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $foto = $_FILES["foto"] ?? null;

    if ($foto === null || $foto["error"] !== UPLOAD_ERR_OK) {
        $mensaje = "Elige una foto.";
    } elseif ($foto["size"] > 2 * 1024 * 1024) {
        $mensaje = "Máximo 2 MB.";
    } else {
        $info = getimagesize($foto["tmp_name"]);
        $tipo = $info["mime"] ?? "";
        if (!isset($tipos[$tipo])) {
            $mensaje = "Solo JPG, PNG o WEBP.";
        } else {
            $nombre = date("Ymd-His") . "-" . bin2hex(random_bytes(4)) . "." . $tipos[$tipo];
            move_uploaded_file($foto["tmp_name"], $carpeta . "/" . $nombre);
            header("Location: ej03-galeria.php");
            exit;
        }
    }
}

// glob() devuelve la lista de archivos que cumplen un patrón
$fotos = glob($carpeta . "/*.{jpg,png,webp}", GLOB_BRACE) ?: [];
rsort($fotos);   // las más nuevas primero (el nombre empieza por la fecha)
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Galería</title></head>
<body>
<h1>Galería (<?= count($fotos) ?> fotos)</h1>
<?php if ($mensaje !== ""): ?><p style="color:red"><?= htmlspecialchars($mensaje) ?></p><?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="foto" accept="image/*">
    <button type="submit">Subir</button>
</form>

<?php foreach ($fotos as $ruta): ?>
    <img src="fotos/<?= basename($ruta) ?>" alt="" width="200" style="margin:4px">
<?php endforeach; ?>
</body>
</html>
