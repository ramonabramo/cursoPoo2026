<?php
declare(strict_types=1);

// 1. Capturar un error que lanza PHP
try {
    echo intdiv(10, 0);                      // PHP lanza DivisionByZeroError
    echo "Esta línea no se ejecuta";
} catch (DivisionByZeroError $error) {
    echo "No se puede dividir entre cero.<br>";
}

// 2. Lanzar nuestras propias excepciones con throw
function retirarDinero(float $saldo, float $cantidad): float
{
    if ($cantidad <= 0) {
        throw new InvalidArgumentException("La cantidad debe ser positiva.");
    }
    if ($cantidad > $saldo) {
        throw new Exception("Saldo insuficiente: tienes {$saldo} €.");
    }
    return $saldo - $cantidad;
}

$operaciones = [50, -10, 500];

foreach ($operaciones as $cantidad) {
    try {
        $nuevoSaldo = retirarDinero(100, $cantidad);
        echo "Retirados {$cantidad} €. Saldo: {$nuevoSaldo} €<br>";
    } catch (InvalidArgumentException $e) {
        echo "Dato incorrecto: " . $e->getMessage() . "<br>";
    } catch (Exception $e) {
        echo "Operación rechazada: " . $e->getMessage() . "<br>";
    } finally {
        echo "<small>(operación de {$cantidad} € registrada)</small><br>";
    }
}
