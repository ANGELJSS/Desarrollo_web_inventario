<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion.php';

// Verificar si se envió el formulario de venta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $idProducto = $_POST['id_producto'];
    $cantidadVendida = $_POST['cantidad'];

    // Consulta SQL para obtener el stock actual del producto
    $consultaStock = "SELECT stock FROM productos WHERE id = $idProducto";
    $resultadoStock = mysqli_query($conn, $consultaStock);

    // Verificar si se obtuvo el resultado de la consulta
    if ($resultadoStock) {
        // Obtener el stock actual del producto
        $stockActual = mysqli_fetch_assoc($resultadoStock)['stock'];

        // Verificar si el stock es suficiente para realizar la venta
        if ($stockActual >= $cantidadVendida) {
            // Calcular el nuevo stock luego de la venta
            $nuevoStock = $stockActual - $cantidadVendida;

            // Consulta SQL para actualizar el stock del producto
            $actualizarStock = "UPDATE productos SET stock = $nuevoStock WHERE id = $idProducto";
            $resultadoActualizar = mysqli_query($conn, $actualizarStock);

            // Verificar si se realizó la actualización del stock
            if ($resultadoActualizar) {
                // Obtener la fecha actual
                $fechaVenta = date('Y-m-d');

                // Consulta SQL para insertar la venta en la tabla "ventas"
                $insertarVenta = "INSERT INTO ventas (id_producto, cantidad, fecha_venta) VALUES ($idProducto, $cantidadVendida, '$fechaVenta')";
                $resultadoInsertar = mysqli_query($conn, $insertarVenta);

                // Verificar si se realizó la inserción de la venta
                if ($resultadoInsertar) {
                    echo 'La venta se realizó exitosamente.';
                    echo '<script>window.close();</script>'; // Cerrar la ventana actual
                } else {
                    echo 'Error al registrar la venta.';
                }
            } else {
                echo 'Error al actualizar el stock.';
            }
        } else {
            echo 'No hay suficiente stock disponible para realizar la venta.';
        }
    } else {
        echo 'Error al obtener el stock del producto.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Módulo de Venta</title>
    <link rel="stylesheet" type="text/css" href="styles_mod.css">
</head>
<body>
    <h1>Módulo de Venta</h1>
    <form method="POST" action="ventas.php">
        <label>ID del producto:</label>
        <input type="text" name="id_producto"><br>
        <label>Cantidad:</label>
        <input type="text" name="cantidad"><br>
        <input type="submit" value="Realizar venta">
    </form>
</body>
</html>
