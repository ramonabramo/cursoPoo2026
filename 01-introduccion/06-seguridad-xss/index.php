<?php
// Primera lección de seguridad: NUNCA te fíes de lo que escribe el usuario.
// Compara qué ocurre al mostrar el texto "tal cual" frente a escaparlo.
$comentario = $_POST['comentario'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>XSS: por qué escapar la salida</title>
</head>
<body>
    <h1>Demostración de XSS</h1>

    <form method="post">
        <label for="comentario">Escribe un comentario:</label><br>
        <input type="text" id="comentario" name="comentario" size="60"
               value="<?= htmlspecialchars($comentario, ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit">Enviar</button>
    </form>
    <p>Prueba a escribir: <code>&lt;b&gt;negrita&lt;/b&gt;</code> o
       <code>&lt;script&gt;alert('XSS')&lt;/script&gt;</code></p>

    <?php if ($comentario !== ''): ?>
        <h2>❌ Sin escapar (VULNERABLE)</h2>
        <div style="border:1px solid red; padding:.5rem;">
            <?= $comentario ?>
        </div>

        <h2>✅ Escapado con htmlspecialchars (SEGURO)</h2>
        <div style="border:1px solid green; padding:.5rem;">
            <?= htmlspecialchars($comentario, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>
</body>
</html>
