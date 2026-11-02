<?php
// Formulario con método POST: los datos viajan en el cuerpo de la petición.
// Mismo archivo para mostrar el formulario y procesarlo.
function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

$errores = [];
$datos   = ['nombre' => '', 'email' => '', 'edad' => '', 'mensaje' => ''];
$enviado = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($datos as $campo => $_) {
        $datos[$campo] = trim($_POST[$campo] ?? '');
    }

    // Validación SIEMPRE en el servidor (la del navegador se puede saltar).
    if ($datos['nombre'] === '') {
        $errores['nombre'] = 'El nombre es obligatorio.';
    }
    if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El email no es válido.';
    }
    if (filter_var($datos['edad'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 120]]) === false) {
        $errores['edad'] = 'La edad debe ser un número entre 1 y 120.';
    }
    if (mb_strlen($datos['mensaje']) < 10) {
        $errores['mensaje'] = 'El mensaje debe tener al menos 10 caracteres.';
    }

    $enviado = empty($errores);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario POST</title>
    <style>
        body { font-family: sans-serif; max-width: 520px; margin: 2rem auto; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        input, textarea { width: 100%; padding: .4rem; box-sizing: border-box; }
        .error { color: #b00020; font-size: .9rem; }
        .ok { background: #e6f4ea; padding: 1rem; border-radius: 6px; }
    </style>
</head>
<body>
    <h1>Contacto (método POST)</h1>

    <?php if ($enviado): ?>
        <div class="ok">
            <p>¡Gracias, <strong><?= e($datos['nombre']) ?></strong>! Hemos recibido tu mensaje.</p>
            <ul>
                <li>Email: <?= e($datos['email']) ?></li>
                <li>Edad: <?= e($datos['edad']) ?></li>
                <li>Mensaje: <?= e($datos['mensaje']) ?></li>
            </ul>
            <p>En una aplicación real aquí guardaríamos los datos o enviaríamos un correo.</p>
        </div>
        <p><a href="index.php">Enviar otro</a></p>
    <?php else: ?>
        <form action="index.php" method="post" novalidate>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= e($datos['nombre']) ?>">
            <?php if (isset($errores['nombre'])): ?><span class="error"><?= e($errores['nombre']) ?></span><?php endif; ?>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= e($datos['email']) ?>">
            <?php if (isset($errores['email'])): ?><span class="error"><?= e($errores['email']) ?></span><?php endif; ?>

            <label for="edad">Edad</label>
            <input type="number" id="edad" name="edad" value="<?= e($datos['edad']) ?>">
            <?php if (isset($errores['edad'])): ?><span class="error"><?= e($errores['edad']) ?></span><?php endif; ?>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" rows="4"><?= e($datos['mensaje']) ?></textarea>
            <?php if (isset($errores['mensaje'])): ?><span class="error"><?= e($errores['mensaje']) ?></span><?php endif; ?>

            <p><button type="submit">Enviar</button></p>
        </form>
    <?php endif; ?>

    <hr>
    <p>Abre las herramientas de desarrollador (F12) → pestaña <em>Network</em> y observa
    la petición POST: la URL no contiene los datos, van en el cuerpo (<em>Payload</em>).</p>
</body>
</html>
