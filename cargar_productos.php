<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gestion_productos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Cambio de estado al presionar el botón 'Eliminar'
if (isset($_GET['eliminar_id'])) {
    $id = intval($_GET['eliminar_id']);
    $sqlEliminar = "UPDATE productos SET estado = 0 WHERE id = $id";
    $conexion->query($sqlEliminar);
    header("Location: index.html"); 
    exit();
}

// Mostrar productos activos
$sql = "SELECT * FROM productos WHERE estado != 0 ORDER BY id DESC";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>";
        $extension = pathinfo($fila['imagen'], PATHINFO_EXTENSION);
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<img src='" . $fila['imagen'] . "' width='100'>";
        } else {
            echo "<a href='" . $fila['imagen'] . "' target='_blank'>Descargar archivo</a>";
        }
        echo "</td>";
        echo "<td>" . $fila['nombre'] . "</td>";
        echo "<td>" . $fila['descripcion'] . "</td>";
        echo "<td>" . $fila['precio'] . "</td>";
        echo "<td>" . $fila['stock'] . "</td>";
        echo "<td>" . $fila['categoria'] . "</td>";
        echo "<td>" . ($fila['estado'] == 1 ? 'Activo' : 'Inactivo') . "</td>";
        echo "<td>
                <a href='editar_producto.php?id=" . $fila['id'] . "'>Editar</a> 
            </td>";
        echo "<td>
            <a href='#' onclick='confirmarEliminacion(" . $fila['id'] . ")'>Eliminar</a>
        </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No hay productos registrados.</td></tr>";
}
?>
