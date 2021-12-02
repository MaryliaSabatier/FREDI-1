<?php

/**
 * po27b : liste des pays
 */
require_once "init.php";
require_once "fpdf/fpdf.php";
require_once "function\pdf_requete.php";
// Crée le tableau d'objets métier "Pays"



$pdf = new FPDF();
$pdf->SetTitle('Exemple pdf ', true);
$pdf->SetAuthor('D.D', true);
$pdf->SetSubject('Liste des PAYS', true);
$pdf->mon_fichier = "liste_pays.pdf";

$pdf->AddPage();

$pdf->Image('img\CERFA_vierge.png', 0, 0, 210, 300);
$pdf->setY(18);
$pdf->setX(165);

$pdf->SetFont('Times', '', 8);
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->SetFont('', 'B');
//NM ORDRE DE RECU
$pdf->SetFillColor(255,255,255);
$pdf->Cell(25, 5, utf8_decode($lignes['0']['nr_ordre']), 1, 0, "R");

//NOM OU DENOMINATION
$pdf->setY(37);
$pdf->Cell(25, 3, utf8_decode($lignes['0']['nr_ordre']), 1, 0, "R");
//CODE ADRESSE

$pdf->setY(46);
$pdf->Cell(16, 3, utf8_decode($lignes['0']['nr_ordre']), 1, 0, "R");
//CODE POSTAL
$pdf->setY(50);
$pdf->setX(30);
$pdf->Cell(19, 3, utf8_decode($lignes['0']['nr_ordre']), 1, 0, "R");
//COMMUNE
$pdf->setY(51);
$pdf->setX(70);
$pdf->Cell(100, 3, utf8_decode($lignes['0']['nr_ordre']), 1, 0, "R");
//OBJET
$pdf->setY(60);
$pdf->setX(50);
$pdf->Cell(100, 3, utf8_decode($lignes['0']['nr_ordre']), 1, 0, "R", true);
//coche la case 
$pdf->SetTextColor(0, 0, 0);
$pdf->setY(79.8);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->setY(84.8);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->setY(90.6);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->setY(99.6);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->setY(105.4);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->setY(115.0);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->setY(123.0);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->setY(132.8);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->setY(138.0);
$pdf->setX(12);
$pdf->Cell(4, 3,  'X', 0, "R", true);

$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
//header('Location: index.php');
 
?>