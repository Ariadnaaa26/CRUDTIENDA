<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Registrar Producto</h1>
    <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required>
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" min="0.01" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" min="0" step="1" required>
        </div>

        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria" required>
                <option value="Dulces">Dulces</option>
                <option value="Abarrotes">Abarrotes</option>
                <option value="Lácteos">Lácteos</option>
                <option value="Frutas">Frutas</option>
                <option value="Otros">Otros</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="archivo">Archivo:</label>
            <input type="file" name="archivo" id="archivo" required>
        </div>

        <div class="form-group botones">
            <input type="submit" value="Registrar Producto">
            <a href="index.html" class="boton-volver">Volver</a>
        </div>
    </form>
</body>
</html>
