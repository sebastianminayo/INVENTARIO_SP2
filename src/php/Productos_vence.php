<?php
require('../../fpdf/fpdf.php');

include "../php/conexion.php";

// Consulta SQL para obtener productos que vencen en una semana o menos
$consulta = "SELECT * FROM producto WHERE fecha_vencimiento <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
$resultado = $conn->query($consulta);

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Configurar fuente y tamaño
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Productos cercanos a Vencer');

// Contenido del PDF
while ($fila = $resultado->fetch_assoc()) {
    $pdf->Ln(); // Salto de línea
    $pdf->Cell(0, 10, "{$fila['nombre_producto']} - Vence el {$fila['fecha_vencimiento']}");
}

// Nombre del archivo PDF (puedes personalizar esto)
$nombre_archivo = 'productos_vencimiento.pdf';

// Salvar o descargar el PDF según tus necesidades
$pdf->Output($nombre_archivo, 'D');

// Cerrar la conexión
$conexion->close();
?>