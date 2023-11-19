<?php
    $nombre_producto = $_POST ['nombre_producto'];
    $total = $_POST ['total'];
    $nro_de_factura = $_POST ['nro_de_factura'];
    $cedula_cliente = $_POST ['cedula_cliente'];
    $cantidad = $_POST ['cantidad'];
    $precio_producto = $_POST ['precio_producto'];

    $contenido = "MinasMarket"
                ."\n**************************************************" 
                ."\nNombre de producto: ".$nombre_producto
                ."\n**************************************************" 
                ."\nPrecio de producto: $".$precio_producto
                ."\n**************************************************" 
                ."\nNumero de factura: ".$nro_de_factura
                ."\n**************************************************" 
                ."\nCedula de cliente: ".$cedula_cliente
                ."\n**************************************************" 
                ."\nCantidad: ".$cantidad
                ."\n**************************************************" 
                ."\nTotal: $".$total
                ."\n**************************************************" 
                ;

    // Especifica la ruta del archivo .txt
    $archivo = "factura".$nro_de_factura.".txt";

    // Escribe el contenido en el archivo
    file_put_contents($archivo, $contenido);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($archivo));

    // Lee y envía el contenido del archivo
    readfile($archivo);
?>