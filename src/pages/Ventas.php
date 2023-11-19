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
  <script src="../../jquery/jquery-3.7.1.min.js"></script>
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
            <a class="nav-link" href="http://localhost/minasMarket">
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


   

    <button class="boton-mas" id="mostrarFormulario"><i class="fas fa-plus"></i> </button>
    
    <form class="styled-form" action="../php/registrar_factura.php" method="post" id="formulario">
      
      
      <div class="form-group">
          <label for="cedulaCliente">Cedula cliente:</label>
          <input type="number" id="cliente" name="cedulaCliente" step="0.01" required>
      </div>

      <div class="form-group">
          <label for="producto">Selecciona un Producto:</label>
          <select id="producto" name="producto">
        <?php
        include "../php/conexion.php";

        $sql = "SELECT nombre_producto, precio_producto FROM producto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo "<option value='" . $row['nombre_producto'] . "' data-precio='" . $row['precio_producto'] . "'>" . $row['nombre_producto'] . "</option>";
            }
        }
        ?>
    </select>
      </div>
      

      <div class="form-group">
          <label for="precio">Precio Unitario:</label>
          <input type="number" id="precio" name="precio" step="0.01" required readonly>
      </div>


      <script>
        $(document).ready(function () {
            $("#producto").change(function () {
                var selectedPrecio = $(this).find(":selected").data("precio");
                $("#precio").val(selectedPrecio);
            });
        });
    </script>

      <div class="form-group">
          <label for="cantidad">Cantidad:</label>
          <input type="number" id="cantidad" name="cantidad" required oninput="validateInput(this)">
      </div>

      <script>
            function validateInput(input) {
              var value = parseFloat(input.value);
              if (value < 0) {

                input.value = 0;
              }
            }
          </script>


     
      <div id="previsualizacion">
          <h2>Factura</h2>
          <p class="Centro" >MinasMarket</p>
          <p class="Centro">3170997865</p>
          <p class="Centro">calle 18 #23-15</p>
          <p >******************************</p>
          <p>Cliente: <span id="clienteSeleccionado"></span></p>
          <p>Producto: <span id="productoSeleccionado"></span></p>
          <p>Precio Unitario: <span id="precioUnitario">0.00</span></p>
          <p>Cantidad: <span id="cantidadSeleccionada">0</span></p>
          <p>Total: <span id="total">0.00</span></p>
      </div>

    

      <input type="submit" name="Registrar_Factura" value="Generar Factura">
  </form>

      <div class="lista-elementos3">';
        <img src="../../img/logoInv.png" alt="Mi imagen" class="logo">';
      </div>';

  <table class="tabla2" border="1">
      <tr>
          <th>Nombre Producto</th>
          <th>Precio producto</th>
          <th>Cantidad</th>
          <th>Cedula cliente</th>
          <th>Numero de factura</th>
          <th>Total</th>
          <th>Generar factura</th>
      </tr>
      <?php
      
      include "../php/conexion.php";

      
      $sql = "SELECT nombre_producto, precio_producto, cantidad, cedula_cliente, nro_de_factura, total FROM factura";
      $result = $conn->query($sql);
        
      if ($result->num_rows > 0) {
          
        while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . $row["nombre_producto"] . '</td>';
              echo '<td>' . $row["precio_producto"] . '</td>';
              echo '<td>' . $row["cantidad"] . '</td>';
              echo '<td>' . $row["cedula_cliente"] . '</td>';
              echo '<td>' . $row["nro_de_factura"] . '</td>';
              echo '<td>' . $row["total"] . '</td>';

              echo '<td>';
              echo '<form action="../php/generar_factura.php" method="post">'; 
              echo '<input type="hidden" name="nombre_producto" value="' . $row["nombre_producto"] . '">';
              echo '<input type="hidden" name="precio_producto" value="' . $row["precio_producto"] . '">';
              echo '<input type="hidden" name="cantidad" value="' . $row["cantidad"] . '">';
              echo '<input type="hidden" name="cedula_cliente" value="' . $row["cedula_cliente"] . '">';
              echo '<input type="hidden" name="nro_de_factura" value="' . $row["nro_de_factura"] . '">';
              echo '<input type="hidden" name="total" value="' . $row["total"] . '">';

              echo '<input type="submit" class="generar-factura" value="Generar factura" name="generar_factura">';
              echo '</form>';
              echo '</td>';
              echo '</tr>';
        }
          } else {
              echo '<div class="lista-elementos2">';
              echo '<h2>No hay facturas registradas en la base de datos.</h2>';
              echo '</div>';
              }

            $conn->close();
            ?>
  </table>


</body>
</html>