<?php
// Probad: ej04-saludo-url.php?nombre=Luis&edad=17
$nombre = $_GET["nombre"] ?? "invitado";
$edad = (int) ($_GET["edad"] ?? 0);

echo "Hola, " . htmlspecialchars($nombre) . "<br>";

if ($edad === 0) {
    echo "No sé tu edad.";
} elseif ($edad >= 18) {
    echo "Eres mayor de edad.";
} else {
    echo "Te faltan " . (18 - $edad) . " años para ser mayor de edad.";
}
