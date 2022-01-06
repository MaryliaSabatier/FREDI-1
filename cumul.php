<?php 
require_once "init.php";
require_once "fpdf/fpdf.php";
include "sql.php";

$sql = "SELECT ligue.id_ligue, ligue.lib_ligue, club.id_club, club.lib_club, motif.id_motif 
FROM club, ligue, motif, adherent, utilisateur, note, ligne  
WHERE ligue.id_ligue = club.id_ligue 
and club.id_club = adherent.id_club
AND adherent.id_utilisateur = utilisateur.id_utilisateur
AND utilisateur.id_utilisateur = note.id_utilisateur
AND note.id_note = ligne.id_note
AND ligne.id_motif = motif.id_motif
GROUP by id_club ";
try {
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $club1 = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

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


$pdf->SetFillColor(224,235,255);  // bleu clair
foreach ($club1 as $club) {
    $pdf->SetFont('', '');
    $pdf->SetX(20);
    $pdf->Cell(25, 3, utf8_decode($club['0']['id_ligue']),  0, "C", true);
}





$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
header('Location: index.php');

?>