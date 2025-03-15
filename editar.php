<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gestion_productos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del producto desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['stock']);
    $estado = $conexion->real_escape_string($_POST['estado']);
    $categoria = $conexion->real_escape_string($_POST['categoria']);

    // Manejo de la imagen
    if (!empty($_FILES['imagen']['name'])) {
        $imagenNombre = "imagenes/" . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenNombre);

        $sql = "UPDATE productos 
                SET nombre='$nombre', descripcion='$descripcion', precio=$precio, 
                    stock=$stock, estado='$estado', categoria='$categoria', imagen='$imagenNombre' 
                WHERE id=$id";
    } else {
        $sql = "UPDATE productos 
                SET nombre='$nombre', descripcion='$descripcion', precio=$precio, 
                    stock=$stock, estado='$estado', categoria='$categoria' 
                WHERE id=$id";
    }

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php"); 
        exit();  // Asegura que no se ejecute más código
    } else {
        echo "❌ Error al actualizar el producto: " . $conexion->error;
    }
    
}

$conexion->close();
?>
