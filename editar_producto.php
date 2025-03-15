<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gestion_productos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del producto desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['stock']);
    $estado = intval($_POST['estado']);  // Corregido para manejar números
    $categoria = $conexion->real_escape_string($_POST['categoria']);

    // Consulta SQL para actualizar el producto
    $sql = "UPDATE productos 
            SET nombre='$nombre', descripcion='$descripcion', precio=$precio, 
                stock=$stock, estado=$estado, categoria='$categoria' 
            WHERE id=$id";

    if ($conexion->query($sql) === TRUE) {
        echo "<p>Producto actualizado correctamente.</p>";
    } else {
        echo "<p>Error al actualizar el producto: " . $conexion->error . "</p>";
    }
}

// Obtener datos del producto para mostrarlos en el formulario
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows == 0) {
    die("<p>Error: Producto no encontrado.</p>");
}

$fila = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Editar Producto</h1>

    <form action="editar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($fila['nombre']); ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" rows="4" required><?php echo htmlspecialchars($fila['descripcion']); ?></textarea>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" value="<?php echo htmlspecialchars($fila['precio']); ?>" min="0.01" step="0.01" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="<?php echo htmlspecialchars($fila['stock']); ?>" min="0" required>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="1" <?php echo ($fila['estado'] == 1) ? 'selected' : ''; ?>>Activo</option>
            <option value="2" <?php echo ($fila['estado'] == 2) ? 'selected' : ''; ?>>Inactivo</option>
        </select>

        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria" required>
            <option value="Dulces" <?php echo ($fila['categoria'] == 'Dulces') ? 'selected' : ''; ?>>Dulces</option>
            <option value="Abarrotes" <?php echo ($fila['categoria'] == 'Abarrotes') ? 'selected' : ''; ?>>Abarrotes</option>
            <option value="Lácteos" <?php echo ($fila['categoria'] == 'Lácteos') ? 'selected' : ''; ?>>Lácteos</option>
            <option value="Frutas" <?php echo ($fila['categoria'] == 'Frutas') ? 'selected' : ''; ?>>Frutas</option>
            <option value="Otros" <?php echo ($fila['categoria'] == 'Otros') ? 'selected' : ''; ?>>Otros</option>
        </select>

        <input type="submit" value="Actualizar">
        <a href="index.html" class="boton-volver">Volver</a>

    </form>
</body>
</html>
