<?php

require 'fpdf.php';
class PDF extends FPDF {

// Cabecera de página
	function Header() {
		$this->SetFont('Times', 'B', 20);
		$this->Image('img/logo.png', 0, 0, 70); //imagen(archivo, png/jpg || x,y,tamaño)
		$this->SetFont('Arial','',20);
		$this->setXY(60, 60);
		$this->Cell(100, 8, 'Reporte de los servicios que los clientes mas cencelan', 0, 1, 'C', 0);
		// $this->Image('img/shinheky.png', 150, 10, 35); //imagen(archivo, png/jpg || x,y,tamaño)
		$this->SetTextColor(246, 130, 14 );
		$this->SetY(15);
		$this->SetX(147);
		$this->Cell(50, 8, 'Barber Shop C.A',0,1);
		$this->SetY(25);
		$this->SetX(147);
		$this->SetFont('Arial','',8);
		$this->Cell(40, 8, 'Venezuela | Lara');
		$this->SetTextColor(30,10,32);
		$this->Ln(30);
		$this->Ln(40);
	}

// Pie de página
	function Footer()
	{
		$this->SetFont('helvetica', 'B', 8);
			$this->SetY(-15);
			$this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
			$this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
			$this->Line(10,287,200,287);
			$this->Cell(0,5,utf8_decode("Barber Shop © Todos los derechos reservados."),0,0,"C");     
	}
// --------------------METODO PARA ADAPTAR LAS CELDAS------------------------------
	var $widths;
	var $aligns;

	function SetWidths($w) {
		//Set the array of column widths
		$this->widths = $w;
	}

	function SetAligns($a) {
		//Set the array of column alignments
		$this->aligns = $a;
	}

	function Row($data, $setX) //yo modifique el script a  mi conveniencia :D
	{
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++) {
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		}

		$h = 8 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h, $setX);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			$this->Rect($x, $y, $w, $h, 'DF');
			//Print the text
			$this->MultiCell($w, 8, $data[$i], 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h, $setX) {
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + $h > $this->PageBreakTrigger) {
			$this->AddPage($this->CurOrientation);
			$this->SetX($setX);

			//volvemos a definir el  encabezado cuando se crea una nueva pagina
			$this->SetFont('Helvetica', 'B', 15);
			$this->Cell(10, 8, 'N', 1, 0, 'C', 0);
			$this->Cell(60, 8, 'Codigo', 1, 0, 'C', 0);
			$this->Cell(80, 8, 'Nombre', 1, 0, 'C', 0);
			$this->Cell(35, 8, 'Precio', 1, 1, 'C', 0);
			$this->SetFont('Arial', '', 12);

		}

		if ($setX == 100) {
			$this->SetX(100);
		} else {
			$this->SetX($setX);
		}

	}

	function NbLines($w, $txt) {
		//Computes the number of lines a MultiCell of width w will take
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0) {
			$w = $this->w - $this->rMargin - $this->x;
		}

		$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb - 1] == "\n") {
			$nb--;
		}

		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb) {
			$c = $s[$i];
			if ($c == "\n") {
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ') {
				$sep = $i;
			}

			$l += $cw[$c];
			if ($l > $wmax) {
				if ($sep == -1) {
					if ($i == $j) {
						$i++;
					}

				} else {
					$i = $sep + 1;
				}

				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			} else {
				$i++;
			}

		}
		return $nl;
	}
// -----------------------------------TERMINA---------------------------------
}

// Creación del objeto de la clase heredada
$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //añade l apagina / en blanco
$pdf->SetMargins(5, 10, 5); //MARGENES
$pdf->SetAutoPageBreak(true, 20); //salto de pagina automatico

// -----------ENCABEZADO------------------
$pdf->SetX(75);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->Cell(15, 8, 'ID', 1, 0, 'C', 0);
$pdf->Cell(20, 8, 'Nombre', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Citas Canceladas', 1, 1, 'C', 0);

// -------TERMINA----ENCABEZADO------------------

$pdf->SetFillColor(233, 229, 235); //color de fondo rgb
$pdf->SetDrawColor(61, 61, 61); //color de linea  rgb

$pdf->SetFont('Arial', '', 10);

//El ancho de las celdas
$pdf->SetWidths(array(15, 20, 30));

// esto no lo mencione en el video pero también pueden poner la alineación de cada COLUMNA!!!
$pdf->SetAligns(array('C','C','C','C','C','C','C','C', ));



//------------------OBTENES LOS DATOS DE LA BASE DE DATOS-------------------------
include("../clases/Conexion.php");
include("../clases/Admin.php");
$Admin = new Admin();
$data = $Admin->mostCanceledServices();
// --------------TERMINA BASE DE DATOS-----------------------------------------------

foreach($data as $service ){
	$pdf->Row(array(
		$service["Id_Servicio"], 
		utf8_decode($service["nombre_servicio"]), 
		utf8_decode($service["citas_canceladas"]),
	), 75);
}

// cell(ancho, largo, contenido,borde?, salto de linea?)

$pdf->Output('avgEmployeeReview.pdf', 'I');
