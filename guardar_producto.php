<?php
include 'conexion.php';

if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
    $nombreArchivo = basename($_FILES['archivo']['name']);
    $rutaDestino = "uploads/" . $nombreArchivo;

    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaDestino)) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria, estado, imagen) 
                VALUES (
                    '{$_POST['nombre']}', 
                    '{$_POST['descripcion']}', 
                    '{$_POST['precio']}', 
                    '{$_POST['stock']}', 
                    '{$_POST['categoria']}', 
                    '{$_POST['estado']}', 
                    '$rutaDestino'
                )";

        if ($conexion->query($sql) === TRUE) {
            header("Location: index.html");
            exit(); 
        } else {
            echo "Error al registrar el producto: " . $conexion->error;
        }
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "Por favor, selecciona un archivo válido.";
}

$conexion->close();
?>
