<?php 
require_once "init.php";
require_once "fpdf/fpdf.php";
require_once "function\pdf_requete.php";

$pdf = new FPDF();
$pdf->SetTitle('Exemple pdf ', true);
$pdf->SetAuthor('D.D', true);
$pdf->SetSubject('Cumule des frais  ', true);
$pdf->mon_fichier = "cumulfrais.pdf";

$pdf->AddPage();

$pdf->setY(18);
$pdf->setX(165);

$pdf->SetFont('Times', '', 26);
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->SetFont('', 'B');
$pdf->Cell(0, 10, utf8_decode("Cumule des frais"), 0, 1, 'C');
$pdf->Ln(8);

// Boucle des lignes
$pdf->SetFont('Times', '', 12);
$pdf->SetTextColor(0, 0, 0); // Noir
// Entête
$pdf->SetFont('', 'B');
$pdf->SetX(20);
$pdf->SetFillColor(211,211,211);
$pdf->Cell(20, 10, utf8_decode("ID Ligue"), 1,0,"C",true);
$pdf->Cell(80, 10, utf8_decode("Nom Ligue"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("ID Club"), 1,0,"C",true);
$pdf->Cell(80, 10, utf8_decode("Nom Club"), 1,0,"C",true);

$fill=false;  // panachage pour la couleur du fond
$pdf->SetFillColor(224,235,255);  // bleu clair
foreach ($club1 as $club) {
    $pdf->SetFont('', '');
    $pdf->SetX(20);
    $pdf->Cell(25, 3, utf8_decode($club['0']['id_ligue']),  0, "C", true);
    $fill=!$fill;  // Inverse le panachage
}





$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
//header('Location: index.php');

?>