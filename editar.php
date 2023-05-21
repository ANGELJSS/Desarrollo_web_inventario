<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';

// Verificar si se ha enviado el formulario de edición
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $referencia = $_POST['referencia'];
    $precio = $_POST['precio'];
    $peso = $_POST['peso'];
    $categoria = $_POST['categoria'];
    $stock = $_POST['stock'];
    
    // Actualizar el producto en la base de datos
    $query = "UPDATE productos SET nombre_producto = '$nombre', referencia = '$referencia', precio = $precio, peso = $peso, categoria = '$categoria', stock = $stock WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        // Cerrar la ventana después de actualizar el producto
        echo '<script>window.close();</script>';
        exit();
    } else {
        // Mostrar mensaje de error si falla la actualización
        echo 'Error al actualizar el producto';
    }
}

// Obtener el ID del producto a editar desde el parámetro de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Obtener los datos del producto de la base de datos
    $query = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre_producto'];
        $referencia = $row['referencia'];
        $precio = $row['precio'];
        $peso = $row['peso'];
        $categoria = $row['categoria'];
        $stock = $row['stock'];
    } else {
        // Redirigir al index.php si el ID del producto no existe
        header('Location: index_prueba.php');
        exit();
    }
} else {
    // Redirigir al index_prueba.php si no se proporciona un ID de producto
    header('Location: index_prueba.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <link rel="stylesheet" type="text/css" href="styles_mod.css">
</head>
<body>
    <h2>Editar Producto</h2>
    <form action="editar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
        <label>Referencia:</label>
        <input type="text" name="referencia" value="<?php echo $referencia; ?>"><br>
        <label>Precio:</label>
        <input type="number" name="precio" value="<?php echo $precio; ?>"><br>
        <label>Peso:</label>
        <input type="number" name="peso" value="<?php echo $peso; ?>"><br>
        <label>Categoría:</label>
        <input type="text" name="categoria" value="<?php echo $categoria; ?>"><br>
        <label>Stock:</label>
        <input type="number" name="stock" value="<?php echo $stock; ?>"><br>
        <input type="submit" name="submit" value="Actualizar">
    </form>
</body>
</html>