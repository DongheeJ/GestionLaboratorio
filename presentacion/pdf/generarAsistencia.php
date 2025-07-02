<?php
require_once __DIR__ . '/../../logica/Asistencia.php';
session_start();
require_once (__DIR__ . '/../../libraries/FPDF/fpdf.php');
$asistencias = $_SESSION['asistencias'] ?? [];

class PDF extends FPDF {
    function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        $s  = str_replace("\r", '', utf8_decode($txt));
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb-1] === "\n") $nb--;
        $sep = -1; $i = 0; $j = 0; $l = 0; $nl = 1;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c === "\n") {
                $i++; $sep = -1; $j = $i; $l = 0; $nl++;
                continue;
            }
            if ($c === ' ') $sep = $i;
            $l += $cw[$c] ?? 0;
            if ($l > $wmax) {
                if ($sep === -1) {
                    if ($i === $j) $i++;
                } else {
                    $i = $sep + 1;
                }
                $sep = -1; $j = $i; $l = 0; $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->SetAutoPageBreak(false);
// $pdf->SetFont('Arial','',9);

function renderHeader($pdf) {
    $x = 8;
    $y = 8;

    $pdf->SetXY($x, $y);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(30, 21, '', 1, 'C');
    $Escudo = __DIR__ . "/../../img/logos/Escudo_UD.png";
    $pdf->Image($Escudo, $x+5, $y, 20, 20);

    $pdf->SetXY($x + 30, $y);
    $pdf->Cell(160, 7, 'PRESTAMO RECURRENTE DE EQUIPOS', 1,0,'C');
    $pdf->Ln(); $pdf->SetX($x + 30);
    $pdf->Cell(160, 7, 'Marcoproceso: Apoyo a lo Misional', 1,0,'C');
    $pdf->Ln(); $pdf->SetX($x + 30);
    $pdf->Cell(160, 7, 'Proceso: Gestion de Laboratorios', 1,0,'C');

    $pdf->SetXY($x + 190, $y);
    $pdf->Cell(50, 7, 'Codigo: GL-PR-001-FR-003', 1);
    $pdf->Ln(); $pdf->SetX($x + 190);
    $pdf->Cell(50, 7, 'Version: 01', 1);
    $pdf->Ln(); $pdf->SetX($x + 190);
    $pdf->Cell(50, 7, 'Fecha de aprobacion: 30/10/2017', 1);

    $pdf->SetXY($x+240, $y);
    $pdf->MultiCell(40, 21, '', 1, 'C');
    $SIGUD = __DIR__ . "/../../img/logos/SIGUD LOGO.jpeg";
    $pdf->Image($SIGUD, $x+243, $y+5, 36, 12);

    $pdf->Ln(1);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->SetX(8);
    $pdf->Cell(25,8,'Laboratorio',1,0,'C',true);
    $pdf->Cell(255,8,'',1);
    $pdf->Ln(9);

    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(8);
    $pdf->Cell(20,10,'FECHA',1,0,'C',true);

    $x = $pdf->GetX(); $y = $pdf->GetY();
    $pdf->MultiCell(50, 5, "PROY.\nCURRICULAR", 1, 'C', true);
    $pdf->SetXY($x+50, $y);

    $x = $pdf->GetX(); $y = $pdf->GetY();
    $pdf->MultiCell(35, 5, "EQUIPO/\nPRACTICA/CLASE", 1, 'C', true);
    $pdf->SetXY($x+35, $y);

    $x = $pdf->GetX(); $y = $pdf->GetY();
    $pdf->MultiCell(50, 5, "CODIGO INTERNO/\nASIGNATURA", 1, 'C', true);
    $pdf->SetXY($x+50, $y);

    $pdf->Cell(40,10,'Docente',1,0,'C',true);

    $x = $pdf->GetX(); $y = $pdf->GetY();
    $pdf->MultiCell(20, 5, "CODIGO\nGRUPO", 1, 'C', true);
    $pdf->SetXY($x+20, $y);

    $x = $pdf->GetX(); $y = $pdf->GetY();
    $pdf->SetFont('Arial','B',7);
    $pdf->MultiCell(20, 5, "#\nESTUDIANTES", 1, 'C', true);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY($x+20, $y);

    $pdf->Cell(12.5,10,'Entrada',1,0,'C',true);
    $pdf->Cell(12.5,10,'Salida',1,0,'C',true);
    $pdf->Cell(20,10,'Firma',1,0,'C',true);
    $pdf->Ln();
}

function renderFooter($pdf) {
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(8);
    $pdf->Cell(24,20,utf8_decode('observaciones: '));
    $pdf->Cell(5,20,utf8_decode('   _____________________________________________________________________________________________________________________'));
    $pdf->Ln(9);
    $pdf->SetX(8);
    $pdf->Cell(24,20,utf8_decode('atendido por: '));
    $pdf->Cell(55,20,utf8_decode('___________________________'));
}

function drawPageBorder($pdf) {
    $pdf->Rect(6, 6, 284, 200); // L, T, W, H
}

$pdf->AddPage();
drawPageBorder($pdf);
renderHeader($pdf);
$currentIndex = 0;
$totalRows = count($asistencias);

while ($currentIndex < $totalRows) {
    $rows = 11;
    $rowsThisPage = min($rows, $totalRows - $currentIndex);
    for ($i = 0; $i < $rowsThisPage; $i++, $currentIndex++) {
        $a = $asistencias[$currentIndex];

        $pdf->SetX(8);
        $pdf->Cell(20,12,utf8_decode($a->fecha),1,0,'C');

        $fields = [
            ['proyectoC', 50],
            ['actividad', 35],
            ['asignatura', 50],
            ['docente', 40]
        ];

        foreach ($fields as [$key, $w]) {
            $txt = $a->$key;
            $lines = $pdf->NbLines($w, $txt);
            $hLine = 12 / $lines;
            $x = $pdf->GetX(); $y = $pdf->GetY();
            $pdf->MultiCell($w, $hLine, utf8_decode($txt), 1, 'L');
            $pdf->SetXY($x + $w, $y);
        }

        $pdf->Cell(20,12,utf8_decode($a->codigoGrupo),1,0,'C');
        $pdf->Cell(20,12,utf8_decode($a->numeroEstudiante),1,0,'C');
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(12.5,12,utf8_decode($a->horaEntrada),1,0,'R');
        $pdf->Cell(12.5,12,utf8_decode($a->horaSalida),1,0,'R');
        $pdf->SetFont('Arial','B',8);

        $firmaPath = __DIR__ . "/../../" . $a->firma;
        if (file_exists($firmaPath) && @exif_imagetype($firmaPath)) {
            $x2 = $pdf->GetX(); $y2 = $pdf->GetY();
            $pdf->Cell(20,12,'',1);
            $pdf->Image($firmaPath, $x2 + 2, $y2 + 1.5, 14, 10);
        } else {
            $pdf->Cell(20,12,'No Firma',1);
        }
        $pdf->Ln();
    }

    $emptyRows = $rows - $rowsThisPage;
    for ($i = 0; $i < $emptyRows; $i++) {
        $pdf->SetX(8);
        $pdf->Cell(20,12,'',1);
        $pdf->Cell(50,12,'',1);
        $pdf->Cell(35,12,'',1);
        $pdf->Cell(50,12,'',1);
        $pdf->Cell(40,12,'',1);
        $pdf->Cell(20,12,'',1);
        $pdf->Cell(20,12,'',1);
        $pdf->Cell(12.5,12,'',1);
        $pdf->Cell(12.5,12,'',1);
        $pdf->Cell(20,12,'',1);
        $pdf->Ln();
    }

    renderFooter($pdf);

    if ($currentIndex < $totalRows) {
        $pdf->AddPage();
        drawPageBorder($pdf);
        renderHeader($pdf);
    }
}

$pdf->Output();
exit;