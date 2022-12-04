<?php

require('./fpdf.php');



class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../includes/conn.php';//llamamos a la conexion BD
      
      

      $consulta_info = $conn->query(" select * from attendance ");//traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('logo2.jpg', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('CLAROAR S.A.C.'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Cal. Lima S/N Sunampe, Chincha, Ica"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Celular : 56 - 946526305"), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : arburua16@gmail.com"), 0, 0, '', 0);
      $this->Ln(10);


      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("LISTA DE HORARIOS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(40, 10, utf8_decode('HORA DE ENTRADA'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('HORA DE SALIDA'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('EMPLEADOS'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('CARGO'), 1, 1, 'C', 1);
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
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../includes/conn.php';

/* CONSULTA INFORMACION DE LA EMPRESA */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_asistencia = $conn->query(" SELECT schedules.time_in, schedules.time_out, employees.firstname, employees.lastname, position.description FROM schedules
INNER JOIN employees ON schedules.id=employees.schedule_id 
INNER JOIN position ON employees.position_id=position.id
ORDER BY schedules.id ASC ");
while ($datos_reporte = $consulta_reporte_asistencia->fetch_object()) {      
   $i = $i + 1;
   /* TABLA */
   $pdf->Cell(40, 10, utf8_decode($datos_reporte->time_in), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($datos_reporte->time_out), 1, 0, 'C', 0);
   $pdf->Cell(60, 10, utf8_decode($datos_reporte->firstname." ".$datos_reporte->lastname), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->description), 1, 1, 'C', 0);
   }


$pdf->Output('Prueba.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)