<?php
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['Registrar_Producto'])){

            $Codigo=$_POST ['Codigo'];
            $nombre=$_POST ['nombre'];
            $precio=$_POST ['precio'];
            $stock=$_POST ['stock'];
            $fecha=$_POST['Fecha_Vence'];
            $proveedor=$_POST['proveedor'];
    
           
    
            $insertarDatos = "INSERT INTO producto VALUES('$Codigo','$nombre','$precio','$stock','$fecha','$proveedor')";
            $ejecutarInsertar = mysqli_query($conn,$insertarDatos);
    
    
        }
        

        
    }

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>MinasMarket</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='../../css/mdb.min.css'>
  <script src='../js/main.js'></script>
</head>
<body>
<div class="lista_edicion">
        <h2>¡Registro Exitoso!</h2>
        <p>Tu registro se ha completado con éxito.</p>
        <button class="btn-secondary" onclick="goBackAndReload()">Regresar</button>
    </div>

    <script>
        function goBackAndReload() {
            window.location.replace(document.referrer);
        }
    </script>

   
</body>
</html>