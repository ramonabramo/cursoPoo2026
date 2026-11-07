<?php
declare(strict_types=1);

$archivo = __DIR__ . "/datos/alumnos.csv";

// ESCRIBIR: cada array se convierte en una línea separada por ;
$alumnos = [
    ["nombre", "edad", "ciudad"],   // cabecera
    ["Marta", 22, "Santander"],
    ["Luis", 31, "Torrelavega"],
    ["Ana", 19, "Laredo"],
];

$f = fopen($archivo, "w");          // "w" = escribir (borra lo que hubiera)
foreach ($alumnos as $fila) {
    fputcsv($f, $fila, ";", '"', "\\");
}
fclose($f);

// LEER: cada línea vuelve a ser un array
$f = fopen($archivo, "r");          // "r" = leer
echo "<table border='1' cellpadding='4'>";
while (($fila = fgetcsv($f, null, ";", '"', "\\")) !== false) {
    echo "<tr><td>" . implode("</td><td>", array_map("htmlspecialchars", $fila)) . "</td></tr>";
}
echo "</table>";
fclose($f);
