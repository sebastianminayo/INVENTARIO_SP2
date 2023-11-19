<?php
include "../php/conexion.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_producto = $_GET['id']; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreProductoEditar = $_POST["nombreProductoEditar"];
    $precioProductoEditar = $_POST["precioProductoEditar"];
    $stockEditar = $_POST["stockEditar"];
    $fechaVencimientoEditar = $_POST["FechaVenceEditar"];
    $codigoEditar = $_POST["CodigoEditar"];
    $proveedor = $_POST["proveedor"];

    $sql = "UPDATE producto SET nombre_proveedor = '$proveedor', nombre_producto = '$nombreProductoEditar', precio_producto = '$precioProductoEditar', stock_producto = '$stockEditar', fecha_vencimiento = '$fechaVencimientoEditar' WHERE codigo_producto = $codigoEditar";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/Productos.php"); 
        exit();
    } else {
      
    }
}


$sql = "SELECT codigo_producto, nombre_producto, precio_producto, stock_producto, fecha_vencimiento, nombre_proveedor FROM producto WHERE codigo_producto = $id_producto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreProductoEditar = $row["nombre_producto"];
    $precioProductoEditar = $row["precio_producto"];
    $stockEditar = $row["stock_producto"];
    $fechaVencimientoEditar = $row["fecha_vencimiento"];
    $codigoEditar = $row["codigo_producto"];
    $nombre_proveedor = $row["nombre_proveedor"];
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>MinasMarket</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='../../css/mdb.min.css'>
  <script src='../js/main.js'></script>
</head>
<body class="body_editar_producto">
    <div class="div-edicion_producto"> 
    <h2>Editar Producto</h2>
    </div>
    <form class="edicion_producto" action="" method="post">
        <div class="form-group-producto">
            <label for="CodigoEditar" class="label_editar_producto">Código del Producto:</label>
            <input type="number" id="CodigoEditar" name="CodigoEditar" class="input_editar_producto"value="<?php echo $codigoEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="nombreProductoEditar" class="label_editar_producto">Nombre del Producto:</label>
            <input type="text" id="nombreProductoEditar" name="nombreProductoEditar" class="input_editar_producto"value="<?php echo $nombreProductoEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="precioProductoEditar" class="label_editar_producto">Precio:</label>
            <input type="number" id="precioProductoEditar" name="precioProductoEditar" step="0.01" class="input_editar_producto"value="<?php echo $precioProductoEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="stockEditar" class="label_editar_producto">Cantidad en Stock:</label>
            <input type="number" id="stockEditar" name="stockEditar" class="input_editar_producto"value="<?php echo $stockEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="FechaVenceEditar" class="label_editar_producto">Fecha de Vencimiento:</label>
            <input type="date" id="FechaVenceEditar" name="FechaVenceEditar" min="2023-10-26" class="input_editar_producto"value="<?php echo $fechaVencimientoEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="Proveedor">Selecciona un proveedor:</label>
            <select id="proveedor" name="proveedor">
                <?php    
                    include "../php/conexion.php";

                    $sql = "SELECT nombre_proveedor FROM proveedor";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $selected = ($row['nombre_proveedor'] == $nombre_proveedor) ? "selected" : "";
                        echo "<option $selected>" . $row['nombre_proveedor'] . "</option>";
                    }
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="button_editar_producto">Guardar Cambios</button>
    </form>
</body>
</html>