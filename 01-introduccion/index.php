<?php
$ejemplos = [
    ['01-hola-mundo/',        'Hola mundo',            'PHP se ejecuta en el servidor y mezcla con HTML'],
    ['02-phpinfo/',           'phpinfo()',             'Configuración de PHP en el servidor'],
    ['03-peticion-servidor/', 'La petición HTTP',      'Qué datos recibe PHP en cada petición'],
    ['04-formulario-get/',    'Formulario GET',        'Datos en la URL: búsquedas y filtros'],
    ['05-formulario-post/',   'Formulario POST',       'Datos en el cuerpo: validación en servidor'],
    ['06-seguridad-xss/',     'Seguridad: XSS',        'Por qué hay que escapar la salida'],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clase 1 - Introducción a PHP y la programación web</title>
    <style>
        body { font-family: sans-serif; max-width: 720px; margin: 2rem auto; }
        li { margin: .6rem 0; }
        small { color: #666; }
    </style>
</head>
<body>
    <h1>Clase 1: Introducción a PHP y la programación web</h1>
    <ol>
        <?php foreach ($ejemplos as [$ruta, $titulo, $desc]): ?>
            <li><a href="<?= $ruta ?>"><?= $titulo ?></a><br><small><?= $desc ?></small></li>
        <?php endforeach; ?>
    </ol>
</body>
</html>
