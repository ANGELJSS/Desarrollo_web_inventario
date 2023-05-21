<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';

// Verificar si se ha enviado el formulario de eliminación
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    
    // Eliminar el producto de la base de datos
    $query = "DELETE FROM productos WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        echo '<script>window.close();</script>'; // Cerrar la ventana actual
        exit();
    } else {
        // Mostrar mensaje de error si falla la eliminación
        echo 'Error al eliminar el producto';
    }
}

// Obtener el ID del producto a eliminar desde el parámetro de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // Redirigir al index.php si no se proporciona un ID de producto
    echo '<script>window.close();</script>'; // Cerrar la ventana actual
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Producto</title>
    <link rel="stylesheet" type="text/css" href="styles_mod.css">
</head>
<body>
    <h2>Eliminar Producto</h2>
    <p>¿Estás seguro de que deseas eliminar este producto?</p>
    <form action="eliminar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Eliminar">
        <button onclick="window.close();" type="button">Cancelar</button>
    </form>

    <script>
        window.addEventListener('beforeunload', function() {
            window.opener = null;
            window.open('', '_self');
            window.close();
        });
    </script>
</body>
</html>




