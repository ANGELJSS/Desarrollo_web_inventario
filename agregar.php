<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';

// ...

// Verificar si se ha enviado el formulario de agregación
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $referencia = $_POST['referencia'];
    $precio = $_POST['precio'];
    $peso = $_POST['peso'];
    $categoria = $_POST['categoria'];
    $stock = $_POST['stock'];

    // Insertar el nuevo producto en la base de datos
    $query = "INSERT INTO productos (nombre_producto, referencia, precio, peso, categoria, stock, fecha_creacion) VALUES ('$nombre', '$referencia', $precio, $peso, '$categoria', $stock, NOW())";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Mostrar la lista de lo que se acaba de agregar
        $query = "SELECT * FROM productos WHERE nombre_producto='$nombre' AND referencia='$referencia' AND precio=$precio AND peso=$peso AND categoria='$categoria' AND stock=$stock";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Mostrar la lista de productos agregados
            echo '<h3>Lista de Productos Agregados</h3>';
            echo '<table>';
            echo '<tr><th>Nombre</th><th>Referencia</th><th>Precio</th><th>Peso</th><th>Categoría</th><th>Stock</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>'.$row['nombre_producto'].'</td>';
                echo '<td>'.$row['referencia'].'</td>';
                echo '<td>'.$row['precio'].'</td>';
                echo '<td>'.$row['peso'].'</td>';
                echo '<td>'.$row['categoria'].'</td>';
                echo '<td>'.$row['stock'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'Error al mostrar la lista de productos';
        }

        // Cerrar la ventana pequeña
        echo '<script>window.close();</script>';
    } else {
        // Mostrar mensaje de error si falla la inserción
        echo 'Error al agregar el producto';
    }
}

// ...

?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Producto</title>
    <link rel="stylesheet" type="text/css" href="styles_mod.css">
</head>
<body>
    <h2>Agregar Producto</h2>
    <form action="agregar.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre"><br>
        <label>Referencia:</label>
        <input type="text" name="referencia"><br>
        <label>Precio:</label>
        <input type="number" name="precio"><br>
        <label>Peso:</label>
        <input type="number" name="peso"><br>
        <label>Categoría:</label>
        <input type="text" name="categoria"><br>
        <label>Stock:</label>
        <input type="number" name="stock"><br>
        <input type="submit" name="submit" value="Agregar">
    </form>
</body>
</html>
