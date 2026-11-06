<?php
declare(strict_types=1);

session_start();

$productos = [
    1 => ["nombre" => "Camiseta", "precio" => 15.00],
    2 => ["nombre" => "Gorra",    "precio" => 9.50],
    3 => ["nombre" => "Taza",     "precio" => 7.95],
];

// El carrito es un array en la sesión: [idProducto => cantidad]
$_SESSION["carrito"] ??= [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? "";
    $id = (int) ($_POST["id"] ?? 0);

    if ($accion === "anadir" && isset($productos[$id])) {
        $_SESSION["carrito"][$id] = ($_SESSION["carrito"][$id] ?? 0) + 1;
    } elseif ($accion === "quitar") {
        unset($_SESSION["carrito"][$id]);
    } elseif ($accion === "vaciar") {
        $_SESSION["carrito"] = [];
    }

    header("Location: ej01-carrito.php");
    exit;
}

$total = 0;
foreach ($_SESSION["carrito"] as $id => $cantidad) {
    $total += $productos[$id]["precio"] * $cantidad;
}

function euros(float $cantidad): string
{
    return number_format($cantidad, 2, ",", ".") . " €";
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Carrito</title></head>
<body>
<h1>Tienda</h1>
<?php foreach ($productos as $id => $p): ?>
    <form method="post" style="display:inline">
        <input type="hidden" name="accion" value="anadir">
        <input type="hidden" name="id" value="<?= $id ?>">
        <button><?= $p["nombre"] ?> (<?= euros($p["precio"]) ?>) ➕</button>
    </form>
<?php endforeach; ?>

<h2>Mi carrito</h2>
<?php if (count($_SESSION["carrito"]) === 0): ?>
    <p>Está vacío.</p>
<?php else: ?>
    <ul>
        <?php foreach ($_SESSION["carrito"] as $id => $cantidad): ?>
            <li>
                <?= $cantidad ?> x <?= $productos[$id]["nombre"] ?> = <?= euros($productos[$id]["precio"] * $cantidad) ?>
                <form method="post" style="display:inline">
                    <input type="hidden" name="accion" value="quitar">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <button>Quitar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><strong>Total: <?= euros($total) ?></strong></p>
    <form method="post"><input type="hidden" name="accion" value="vaciar"><button>Vaciar carrito</button></form>
<?php endif; ?>
</body>
</html>
