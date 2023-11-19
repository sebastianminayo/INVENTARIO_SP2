<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>MinasMarket</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='../../css/mdb.min.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src='../js/main.js'></script>
</head>
<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-black" style="padding: 20px;">
    <div class="container-fluid">
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarExample01"
        aria-controls="navbarExample01"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0" style="font-size: 18px;">
          <li class="nav-item">
            <a class="nav-link" href="http://localhost:8080/minasMarket">
              <i class="fas fa-home"></i> Home
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="Productos.php">
              <i class="fas fa-shopping-bag"></i> Productos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Proveedores.php">
              <i class="fas fa-truck"></i> Proveedores
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Ventas.php">
              <i class="fas fa-chart-bar"></i> Ventas
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>



   
  
    <button class="boton-mas" id="mostrarFormulario"><i class="fas fa-plus"></i></button>
    <form class="styled-form" action="../php/registrar_producto.php" method="post" id="formulario" onsubmit="return validateForm()">

      <div class="form-group">
        <label for="Codigo">Codigo del Producto:</label>
        <input type="number" id="Codigo" name="Codigo" required>
      </div>

      <div class="form-group">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required oninput="validateInput(this)">
      </div>

      <div class="form-group">
        <label for="stock">Cantidad en Stock:</label>
        <input type="number" id="stock" name="stock" required oninput="validateInput(this)">
      </div>

      <script>
        function validateInput(input) {
          var value = parseFloat(input.value);
          if (value < 0) {
            input.value = 0;
          }
        }

        function validateForm() {
          // Obtener el valor seleccionado del campo de selección
          var proveedorSelect = document.getElementById("proveedor");
          var selectedValue = proveedorSelect.options[proveedorSelect.selectedIndex].value;

          // Validar que se haya seleccionado un proveedor
          if (selectedValue === "") {
            alert("Por favor, selecciona un proveedor.\nPuede que aun no hayas registrado proveedores.");
            return false; // Evita que el formulario se envíe
          }

          return true; // Permite que el formulario se envíe
        }
      </script>

      <div class="form-group">
        <label for="Proveedor">Selecciona un proveedor:</label>
        <select id="proveedor" name="proveedor">
          <option value="">Selecciona un proveedor</option>
          <?php    
            include "../php/conexion.php";

            $sql = "SELECT nombre_proveedor FROM proveedor";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['nombre_proveedor'] . "'>" . $row['nombre_proveedor'] . "</option>";
              }
            }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="Fecha_Vence">Fecha de Vencimiento:</label>
        <input type="date" id="Fecha_Vence" name="Fecha_Vence" min="2023-10-26" required>
      </div>

      <input type="submit" value="Registrar Producto" name="Registrar_Producto">
</form>

      <form class="styled-form2" action="../php/Productos_vence.php" method="post">
        <input type="submit" value="Generar Informe">
      </form>

      <div>
        <div class="lista-elementos2">
          <img src="../../img/logoInv.png" alt="Mi imagen" class="logo">
        </div>
    

      <table border="1">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Fecha de Vencimiento</th>
            <th>Proveedor</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../php/conexion.php";

        $sql = "SELECT codigo_producto, nombre_producto, precio_producto, stock_producto, fecha_vencimiento, nombre_proveedor FROM producto";
        $result = $conn->query($sql);

       

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["codigo_producto"] . '</td>';
                echo '<td>' . $row["nombre_producto"] . '</td>';
                echo '<td>' . $row["precio_producto"] . '</td>';
                echo '<td>' . $row["stock_producto"] . '</td>';
                echo '<td>' . $row["fecha_vencimiento"] . '</td>';
                echo '<td>' . $row["nombre_proveedor"] . '</td>';
                echo '<td><a class="editar-producto" href="../php/editar_producto.php?id=' . $row["codigo_producto"] . '">Editar</a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="6">No hay productos registrados en la base de datos.</td>';
            echo '</tr>';
        }

        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>

