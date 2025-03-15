<?php
$host = "localhost";  // Cambia si tu host es diferente
$usuario = "root";    // Cambia si tu usuario es diferente
$clave = "";          // Cambia si tienes contraseña
$base_datos = "gestion_productos";  // Cambia por el nombre correcto

$conexion = new mysqli($host, $usuario, $clave, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
