<?php
include "../php/conexion.php";

$id_proveedor = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreProveedorEditar = $_POST["nombreProveedorEditar"];
    $telefonoProveedorEditar = $_POST["telefonoProveedorEditar"];
    $nitEditar = $_POST["nitEditar"];
    $descripcionEditar = $_POST["DescripionEditar"];
    $idProveedorEditar = $_POST["idProveedorEditar"];

    $sql = "UPDATE proveedor SET nombre_proveedor = '$nombreProveedorEditar', telefono_proveedor = '$telefonoProveedorEditar', nit = '$nitEditar', descripcion = '$descripcionEditar' WHERE id_proveedor = $idProveedorEditar";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/proveedores.php"); 
        exit();
    } else {
        
    }
}


$sql = "SELECT nombre_proveedor, telefono_proveedor, nit, descripcion FROM proveedor WHERE id_proveedor = $id_proveedor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreProveedorEditar = $row["nombre_proveedor"];
    $telefonoProveedorEditar = $row["telefono_proveedor"];
    $nitEditar = $row["nit"];
    $descripcionEditar = $row["descripcion"];
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

<body>
<div class="div-edicion_producto"> 
    <h2>Editar Proveedor</h2>
    </div>
    <form class="edicion_producto" action="" method="post"> 
        <div class="form-group-producto">
            <label for="nombreProveedorEditar">Nombre del proveedor:</label>
            <input type="text" id="nombreProveedorEditar" name="nombreProveedorEditar" class="input_editar_producto"value="<?php echo $nombreProveedorEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="telefonoProveedorEditar" class="label_editar_producto">Teléfono del proveedor:</label>
            <input type="text" id="telefonoProveedorEditar" name="telefonoProveedorEditar" class="input_editar_producto"value="<?php echo $telefonoProveedorEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="nitEditar" class="label_editar_producto">Nit:</label>
            <input type="number" id="nitEditar" name="nitEditar" class="input_editar_producto"value="<?php echo $nitEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="DescripionEditar" class="label_editar_producto">Descripción:</label>
            <input type="text" id="DescripionEditar" name="DescripionEditar" class="input_editar_producto"value="<?php echo $descripcionEditar; ?>" required>
        </div>
        <div class="form-group-producto">
            <label for="idProveedorEditar" class="label_editar_producto">ID:</label>
            <input type="number" id="idProveedorEditar" name="idProveedorEditar" class="input_editar_producto"value="<?php echo $id_proveedor; ?>" required>
        </div>
        <button type="submit" class="button_editar_producto">Guardar Cambios</button>
    </form>
</body>
</html>