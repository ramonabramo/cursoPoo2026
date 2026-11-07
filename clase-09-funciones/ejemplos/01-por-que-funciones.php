<?php
// SIN funciones: el mismo cálculo copiado tres veces
$camiseta = 15;
echo "Camiseta: " . number_format($camiseta * 1.21, 2, ",", ".") . " €<br>";
$pantalon = 32.5;
echo "Pantalón: " . number_format($pantalon * 1.21, 2, ",", ".") . " €<br>";
$zapatillas = 59.9;
echo "Zapatillas: " . number_format($zapatillas * 1.21, 2, ",", ".") . " €<br>";

echo "<hr>";

// CON una función: la receta se escribe UNA vez
function precioConIva($precio)
{
    return number_format($precio * 1.21, 2, ",", ".") . " €";
}

echo "Camiseta: " . precioConIva(15) . "<br>";
echo "Pantalón: " . precioConIva(32.5) . "<br>";
echo "Zapatillas: " . precioConIva(59.9) . "<br>";
// Si mañana cambia el IVA, solo hay que tocar UNA línea
