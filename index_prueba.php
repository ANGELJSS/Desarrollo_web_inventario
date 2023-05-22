<!-- index.php -->
<?php
// Paso 1: Conexión a la base de datos
require_once 'conexion.php';

// Paso 2: Obtener la página actual y el tamaño de página
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = isset($_GET['per_page']) ? $_GET['per_page'] : 5; // Número de registros por página

// Paso 3: Calcular el offset para la consulta
$offset = ($page - 1) * $perPage;

// Paso 4: Obtener el total de registros en la tabla
$queryTotal = "SELECT COUNT(*) AS total FROM productos";
$resultTotal = mysqli_query($conn, $queryTotal);
$totalRows = mysqli_fetch_assoc($resultTotal)['total'];

// Paso 5: Obtener los registros para la página actual
$query = "SELECT * FROM productos LIMIT $offset, $perPage";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Inventario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Estilos para la paginación */
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 4px;
            color: #333;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover {
            background-color: #ebebeb;
        }

        .pagination .current-page {
            font-weight: bold;
            background-color: #FFC107;
            color: black;
        }

        .per-page {
            margin-bottom: 10px;
        }
    </style>
    <script>
        function abrirVentanaAgregar() {
            window.open("agregar.php", "Agregar Producto", "width=500, height=500");
        }
    </script>

    <script>
        function abrirVentanaVentas() {
            window.open("ventas.php", "Venta de productos", "width=500, height=500");
        }
    </script>

    <script>
        function abrirVentanaEditar(id) {
            window.open("editar.php?id=" + id, "Editar Producto", "width=500, height=500");
        }
    </script>

    <script>
        function abrirVentanaEliminar(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                window.open("eliminar.php?id=" + id, "Eliminar Producto", "width=500, height=500");
            }
        }
    </script>
</head>
<body>
    <!-- Agregar los botones en las posiciones deseadas -->
    <div class="container">
        <button id="btn-agregar" onclick="abrirVentanaAgregar()">Agregar Producto</button>
        <button id="btn-ventas" onclick="abrirVentanaVentas()">Venta de productos</button>
    </div>

    <h1 class="title">Listado de Productos</h1>
    
    <div class="per-page">

        <label for="per-page-select">Mostrar:</label>
        <select id="per-page-select" onchange="changePerPage(this)">
        <option value="5" <?php if ($perPage == 5) echo "selected"; ?>>5</option>
        <option value="10" <?php if ($perPage == 10) echo "selected"; ?>>10</option>
        <option value="20" <?php if ($perPage == 20) echo "selected"; ?>>20</option>
        <option value="100" <?php if ($perPage == 100) echo "selected"; ?>>100</option>
        </select>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Referencia</th>
            <th>Precio</th>
            <th>Peso</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>
                <td><?php echo $row['referencia']; ?></td>
                <td><?php echo $row['precio']; ?></td>
                <td><?php echo $row['peso']; ?></td>
                <td><?php echo $row['categoria']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td><?php echo $row['fecha_creacion']; ?></td>
                <td class='acciones'>
                <button onclick="abrirVentanaEditar(<?php echo $row['id']; ?>)">Editar</button>
                <button onclick="abrirVentanaEliminar(<?php echo $row['id']; ?>)">Eliminar</button>
                </td>
            </tr>
        <?php } ?>
    </table>
    
    <div class="pagination">
    <?php
    $totalPages = ceil($totalRows / $perPage); // Total de páginas
    $prevPage = $page - 1; // Página anterior
    $nextPage = $page + 1; // Página siguiente
    
    if ($page > 1) {
        echo "<a href='index_prueba.php?page=$prevPage&per_page=$perPage'>Anterior</a>";
    }
    
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page) {
            echo "<span class='current-page'>$i</span>";
        } else {
            echo "<a href='index_prueba.php?page=$i&per_page=$perPage'>$i</a>";
        }
    }
    
    if ($page < $totalPages) {
        echo "<a href='index_prueba.php?page=$nextPage&per_page=$perPage'>Siguiente</a>";
    }
    ?>
    </div>

    <script>
    function changePerPage(selectElement) {
        var perPage = selectElement.value;
        var url = 'index_prueba.php?page=1&per_page=' + perPage;
        window.location.href = url;
    }
    </script>

</body>
</html>