<?php

require('../fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('BARBER SHOP'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color


      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE RESEÑAS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(10, 10, utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('PUNTUACION'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('STATUS'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('ID CLIENTE'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('NOMBRE CLIENTE'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('APELLIDO CLIENTE'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//include '../../recursos/Recurso_conexion_bd.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde


include "../../clases/Conexion.php";
include "../../clases/Review.php";
$Review = new Review();

// Obtiene todas las reseñas
$reviews = $Review->getBarberReviews();

// Itera sobre las reseñas
foreach ($reviews as $review) {
    $pdf->Cell(10, 10, utf8_decode($review['id_Resena_Barberia']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($review['Puntuacion']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($review['status']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($review['id_Cliente']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($review['Nombre']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($review['Apellido']), 1, 1, 'C', 0);
}

$pdf->Output('reporteReseñas.pdf', 'I');



